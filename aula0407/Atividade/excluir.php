<?php
include 'conexao.php';

if (isset($_GET['ra'])) {
    $ra = $_GET['ra'];
    $sql = "DELETE FROM aluno WHERE ra = '$ra'";

    if (mysqli_query($con, $sql)) {
        echo "Exclusão realizada com sucesso!";
        header("Location: ver.php");
        exit();
    } else {
        echo "Erro: " . mysqli_error($con);
    }
}
?>
<a href="ver.php">Voltar</a>