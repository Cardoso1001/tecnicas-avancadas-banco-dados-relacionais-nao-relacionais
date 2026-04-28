<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ra = $_POST['ra'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    $sql = "INSERT INTO aluno (ra, nome, cpf) VALUES ('$ra', '$nome', '$cpf')";

    if (mysqli_query($con, $sql)) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro: " . mysqli_error($con);
    }
}
?>
<a href="index.html">Voltar</a>