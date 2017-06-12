<?php
$servername = "sideshowbob";
$username = "root";
$password = "root";
$dbname = "rooda";
$i = 0;
$insert = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if( isset($_POST['submit']) )
{
    //be sure to validate and clean your variables
    $val1 = htmlspecialchars($_POST['val1']);
    $val2 = htmlentities($_POST['val2']);
    $val3 = htmlentities($_POST['val3']);
    $val4 = htmlentities($_POST['val4']);
    $val5 = htmlentities($_POST['val5']);
    $val6 = htmlentities($_POST['val6']);
    $val7 = htmlentities($_POST['val7']);
    $val8 = htmlentities($_POST['val8']);
    $val9 = htmlentities($_POST['val9']);
    $val10 = htmlentities($_POST['val10']);
    $val11 = htmlentities($_POST['val11']);
    $id = htmlentities($_POST['id_turma']);

    if($val1 && $val2 && $val3 && $val4 && $val5 && $val6 && $val7 && $val8 && $val9 && $val10 && $val11){
    	$insert = 1;
    	$update = "UPDATE `Disciplina` SET `nomeDisciplina`= '$val1',`codAtividadeEnsino`= $val2,`departamento`= '$val3',`unidade`= '$val4',`codUFRGS`= '$val5',`creditos`= $val6,`ementa`= '$val7',`cargaHoraria`= '$val8',`descricao`= '$val9',`cronograma`= '$val10',`bibliografia`= '$val11' WHERE `codDisciplina` = $id";
    	if ($conn->query($update) === TRUE) {
    		$query_result = TRUE;
    	}
    }
    else{
    	if(is_null($val2)){
    		$insert = 0;
    	}
    }
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
	.warning {
		color: white;
		background-color: red;
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
		$retrieve_turma_info = "SELECT `nomeDisciplina`, `codAtividadeEnsino`, `departamento`, `unidade`, `codUFRGS`, `creditos`, `ementa`, `cargaHoraria`, `descricao`,`cronograma`, `bibliografia` FROM `Disciplina` WHERE `codDisciplina` = $id_turma";
		$result = mysqli_query($conn,$retrieve_turma_info);
 	
		if(!is_null($insert) && $insert){
			echo "<script>alert('Mudanças efetuadas');</script>";
		}
		elseif(is_null($insert)){
			echo '<p class="warning"> PREENCHA TODOS OS CAMPOS </p><br>';
		}
 	?>
 	<form action="" method="POST">
	<?php	
		while($result_row = mysqli_fetch_array($result)){
			while($i < 11){
					printf("<p>$array_labels[$i]:<br>");
					printf('<input type="text" name="val'.($i + 1).'" id="val'.($i + 1).'" value="'.utf8_encode($result_row[$i]).'"></input>');
				$i++;
			}
		}
	?>
	<input type='hidden' name='id_turma' value='<?php echo "$id_turma";?>'/>
	<input type="submit" name="submit" value="Salvar"></input>
	</form>
	</div>
</body>
<?php


?>