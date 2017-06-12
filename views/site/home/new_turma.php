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

    form {
        padding: 30px 30px 0px 30px;
    }

</style>
<?php
if( isset($_POST['submit']) )
{
    //be sure to validate and clean your variables
    $val1 = htmlentities($_POST['val1']);
    $val2 = htmlentities($_POST['val2']);
    $val3 = htmlentities($_POST['val3']);
    $val4 = htmlentities($_POST['val4']);
    $val5 = htmlentities($_POST['val5']);
    $val6 = htmlentities($_POST['val6']);
    $val7 = htmlentities($_POST['val7']);
    $val8 = htmlentities($_POST['val8']);
    $val9 = htmlentities($_POST['val9']);
    $val10 = htmlentities($_POST['val10']);
    $teste_exist = intval($val2);
    //then you can use them in a PHP function. 
    $turma_disc = "SELECT `codDisciplina` FROM `Disciplina` WHERE `codAtividadeEnsino` = $teste_exist";
    $result = mysqli_query($conn,$turma_disc);
    $row2 = mysqli_fetch_array($result);
    
    $required = array('val1', 'val2', 'val3', 'val4', 'val5', 'val6', 'val7', 'val8', 'val9', 'val10');
    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach($required as $field) {
        if (empty($_POST[$field])) {
            $error = true;
        }
    }
    if(!$error){
        if(is_null($row2)){
            $query = "INSERT INTO `Disciplina`(`nomeDisciplina`, `codAtividadeEnsino`, `departamento`, `unidade`,`creditos`, `ementa`, `cargaHoraria`, `descricao`,`cronograma`, `bibliografia`) VALUES ('".$val1."','".$val2."', '".$val3."','".$val4."','".$val5."','".$val6."','".$val7."','".$val8."','".$val9."','".$val10."')";
            
            if(mysqli_query($conn, $query)){
                $query2 = "INSERT INTO `Turma`(`codDisciplina`) VALUES (".mysqli_insert_id($conn).")";
                if(mysqli_query($conn, $query2)){
                     $query3 = "INSERT INTO `TurmaUsuario`(`codTurma`, `codUsuario`, `associacao`) VALUES (".mysqli_insert_id($conn).", 32482, 'P')";
                     if(mysqli_query($conn, $query3)){
                        echo "<script>alert('Cadastro efetuado.');</script>";
                    }
                }
            }
        }
        else{
            echo "<script>alert('Código de atividade já existente, cadastro cancelado.');</script>";
        }
    }
    else{
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>

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

<form action="" method="POST">
    Nome da Disciplina: 
    <input type="text" name="val1" id="val1"></input>
    <br><br>
    Código da Disciplina:
    <input type="text" name="val2" id="val2"></input>
    <br><br>
    Departamento:
    <input type="text" name="val3" id="val3"></input>
    <br><br>
    Unidade
    <input type="text" name="val4" id="val4"></input>
    <br><br>
    Créditos
    <input type="text" name="val5" id="val5"></input>
    <br><br>
    Ementa
    <input type="text" name="val6" id="val6"></input>
    <br><br>
    Carga Horária
    <input type="text" name="val7" id="val7"></input>
    <br><br>
    Descrição
    <input type="text" name="val8" id="val8"></input>
    <br><br>
    Cronograma
    <input type="text" name="val9" id="val9"></input>
    <br><br>
     Bibliografia (para inserir links adicione dois '**' após a url)
    <input type="text" name="val10" id="val10"></input>
    <br><br>
    <input type="submit" name="submit" value="Criar"></input>

</form>
</body>