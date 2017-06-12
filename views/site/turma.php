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
		<?php var_dump($_GET['id'];) ?>
	</div>