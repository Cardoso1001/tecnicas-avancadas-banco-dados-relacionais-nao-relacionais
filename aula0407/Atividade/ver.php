<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Alunos</title>
</head>
<body>
    <a href="index.html">Voltar</a>
    <h2>Lista de Alunos</h2>
    <table border="1">
        <tr>
            <th>RA</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ações</th>
        </tr>
        <?php
        include 'conexao.php';
        $query = "SELECT * FROM aluno";
        $result = mysqli_query($con, $query);

        while ($linha = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $linha['ra'] . "</td>";
            echo "<td>" . $linha['nome'] . "</td>";
            echo "<td>" . $linha['cpf'] . "</td>";
            echo "<td>";
            echo "<a href='alterar.php?ra=" . $linha['ra'] . "'>Alterar</a> | ";
            echo "<a href='excluir.php?ra=" . $linha['ra'] . "' onclick='return confirm(\"Tem certeza?\")'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>