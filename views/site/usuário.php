<?php
$servername = "sideshowbob";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>

<head>
</head>
<body>
	<div>
		<h2>BEM VINDO</h2>
	</div>
</body>