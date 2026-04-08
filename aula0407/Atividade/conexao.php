<?php
$dbname = "fatec";
$servername = "localhost";
$username = "adm";
$password = "123";

$con   = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}
?>
