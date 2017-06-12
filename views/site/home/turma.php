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

	.title{
		float: left;
		padding-left: 50px;
		width: 400px;
		background-color: #ffffff;
		margin-left: 50px;
	}

	img {
    	display: block;
    	margin: 0 auto;
	}

	.test{
		margin-bottom: 5px;
		background-color: #fff;
	}

</style>
<head>
</head>
<body bgcolor="E6E6E6">
	<div class="menubar" >
		<p>menubar_placeholder</p>
	</div>
	<div class="sidebar">
		<p>sidebar_placeholder</p>
		<img src="default_profile.png" width="100" height="100">
	</div>
	<div class="title">
		<?php 
		$array_labels = ['Disciplina', 'Código', 'Departamento','Unidade', 'Código UFRGS' , 'Créditos', 'Ementa', 'Carga Horária','Descrição', 'Cronograma', 'Bibliografia'];
		$id_turma = $_GET['id'];
		$cod_turma =$_GET['cod'];
		$retrieve_turma_info = "SELECT `nomeDisciplina`, `codAtividadeEnsino`, `departamento`, `unidade`, `codUFRGS`, `creditos`, `ementa`, `cargaHoraria`, `descricao`,`cronograma`, `bibliografia` FROM `Disciplina` WHERE `codDisciplina` = $id_turma";
		$result = mysqli_query($conn,$retrieve_turma_info); 
		while($result_row = mysqli_fetch_array($result)){
			while($i < 11){
				printf("<p>$array_labels[$i]:<br>".utf8_encode($result_row[$i])."</p>");
				$i++;
			}
		}

		?>
	<?php 
		if(isset($_POST['add'])){
			$query3 = "INSERT INTO `TurmaUsuario`(`codTurma`, `codUsuario`, `associacao`) VALUES (".$cod_turma.",".$_POST['cod'].", 'P')";
            if(mysqli_query($conn, $query3)){
           		echo "<script>alert('Aluno adicionado');</script>";
            }
		}
	?>
	</div>
	<a href="edit_turma.php?id=<?php echo $id_turma; ?>" style="margin-left: 20px;">Editar esta disciplina</a>
	<div class="title">
		<?php 
			$user_turma = "SELECT `codUsuario` FROM `TurmaUsuario` WHERE `codTurma` = ".$cod_turma;
			$result2 = mysqli_query($conn,$user_turma);
			while($result_row = mysqli_fetch_array($result2)){
				$nome = "SELECT `nome` FROM `Usuario` WHERE `codUsuario` = $result_row[0]";
				$result3 = mysqli_query($conn,$nome);
				$row3 = mysqli_fetch_array($result3);
				echo "<p>".$row3[0]."</p>";
			}
		 ?>
	<form action="" method="POST">
		Adicionar Aluno <br>
		<input type="text" name="cod">
		<input type="submit" name="add" value="add"></input>
	</form>
	</div>
	<div>
		<form action="../home/usuário.php" method="POST">
			<input type="submit" name="del" value="Deletar esta disciplina"></input>
		</form>
	</div>
</body>