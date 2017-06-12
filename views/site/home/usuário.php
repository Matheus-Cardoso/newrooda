<?php
$servername = "sideshowbob";
$username = "root";
$password = "root";
$dbname = "rooda";
$i = 0;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<meta charset="UTF-8">
<style type="text/css">
	.sidebar{
		width: 300px;
		height: calc(100% - 25px);
		float: left;
		background-color: #ffffff;
	}
	.menubar{
		border: 1px #000;
	}
	.menubar > p{
		display: inline;
	}

	.title{
		float: left;
		padding-left: 50px;
		width: 400px;
	}

	img {
    	display: block;
    	margin: 0 auto;
	}

	.test{
		margin-bottom: 5px;
		background-color: #fff;
	}

	.logout{
		float: right;
	}

	.box_criar{
		width: 100px;
		height: 100px;
		padding: 14px 25px;
		text-align: center;
		background-color: #1c90f3;
		text-decoration: none;
		color: white;
	}

</style>
<head>
</head>
<body bgcolor="E6E6E6">
	<div class="menubar" >
		<p>menubar_placeholder</p>
		<a class="logout" href="../index.html">Sair</a>
	</div>
	<div class="sidebar">
		<p>sidebar_placeholder</p>
		<img src="default_profile.png" width="100" height="100">
	</div>
	<div  class="title">
		<h2>Bem Vindo(a) <a href="./editar_conta">(editar perfil)</a></h2>
		<br><br><p>Disciplinas Ativas:<br></p>
		<br><br><p>Disciplinas Inativas:<br></p>
		<?php 
			$user = $_POST["user_rooda"];
			$user_turma = "SELECT * FROM `TurmaUsuario` WHERE `codUsuario` = ".$user;
			$result = mysqli_query($conn,$user_turma);
			while($row = mysqli_fetch_array($result)){
				$turma_disc = "SELECT `codDisciplina` FROM `Turma` WHERE `codTurma` = $row[0]";
				$result2 = mysqli_query($conn,$turma_disc);
				while($row2 = mysqli_fetch_array($result2)){
					$i++;
					$disc = "SELECT `nomeDisciplina`, `fim` FROM `Disciplina` WHERE `codDisciplina` = $row2[0]";
					$result3 = mysqli_query($conn,$disc);
					$row3 = mysqli_fetch_array($result3);
					echo '<a class="test" href="./turma.php?id='.$row2[0].'&cod='.$row[0].'">'.utf8_encode($row3[0]).'</a><br>';
				}
			}

		?>
	<br><br><br>
	<a class="box_criar" href="new_turma.php">Criar Turma</a>
	</div>
	
</body>