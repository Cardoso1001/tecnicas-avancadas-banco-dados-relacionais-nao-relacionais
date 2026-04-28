<?php
include 'conexao.php';

if (isset($_GET['ra'])) {
    $ra = $_GET['ra'];
    $query = "SELECT * FROM aluno WHERE ra = '$ra'";
    $result = mysqli_query($con, $query);
    $aluno = mysqli_fetch_array($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ra = $_POST['ra'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];

    $sql = "UPDATE aluno SET nome = '$nome', cpf = '$cpf' WHERE ra = '$ra'";

    if (mysqli_query($con, $sql)) {
        echo "Alteração realizada com sucesso!";
        header("Location: ver.php");
        exit();
    } else {
        echo "Erro: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Aluno</title>
</head>
<body>
    <a href="ver.php">Voltar</a>
    <h2>Alterar Aluno</h2>
    <form action="alterar.php" method="post">
        RA: <input type="text" name="ra" value="<?php echo $aluno['ra']; ?>" readonly><br>
        Nome: <input type="text" name="nome" value="<?php echo $aluno['nome']; ?>" required><br>
        CPF: <input type="text" name="cpf" value="<?php echo $aluno['cpf']; ?>" required><br>
        <input type="submit" value="Alterar">
    </form>
</body>
</html>