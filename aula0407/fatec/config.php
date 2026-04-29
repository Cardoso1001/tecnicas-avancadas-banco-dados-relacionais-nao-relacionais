<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'adm');
define('DB_PASS', '123');
define('DB_NAME', 'fatec');

function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die(json_encode(['error' => 'Conexão falhou: ' . $conn->connect_error]));
    }
    $conn->set_charset('utf8');
    return $conn;
}
?>
