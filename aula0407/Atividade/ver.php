<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.html">Voltar</a>
    <table>
        <tr><td>Alunos</td></tr>
        <tr><?php
            $query  = "select * from alunos";
            $qw     = mysqli_query($con,$query);

            while($linha = mysqli_fetch_array($qw)) {
                ?>
                <td><?php echo $linha['nome'];?></td>
                <?php
            }
        ?></tr>
    </table>
</body>
</html>