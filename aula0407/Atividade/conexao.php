<?php
    $dbname = "fatec";
    $servername = "localhost";
    $username = "adm";
    $password = "123";

    $con   = mysqli_connect($servername, $username, $password, $dbname);
    if ($con->connect_error) {
        die('Erro na conexão: ' . $con->connect_error);
    }
?>
