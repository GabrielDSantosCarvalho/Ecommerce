<?php

include("cabecalho4.php");


$status = "s";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];
}


if ($status == 's') {
    $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
} else {
    $sql = "SELECT * FROM clientes WHERE cli_status = 'n'";
}


$retorno = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTAR DE CLIENTES</title>
    <link rel="stylesheet" type="text/css" href="cli.css">
</head>

<body>
    <div id="background">
        <form action="listecliente.php" method="post">
            <input type="radio" name="status" class="radio" value="s" required onclick="submit()" <?= $status == "s" ? "checked" : "" ?>>INATIVOS
            <br>
            <input type="radio" name="status" class="radio" value="n" required onclick="submit()" <?= $status == "n" ? "checked" : "" ?>>ATIVOS
            <br>
            <br>
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>NOME</th>
                    <th>SALA</th>
                    <th>CURSO</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO</th>
                </tr>
                <?php
                while ($tbl = mysqli_fetch_array($retorno)) {
                ?>
                    <tr>
                        
                        <td><?= $tbl[1] ?></td>
                        <td><?= $tbl['cli_sala'] ?></td>
                        <td><?= $tbl['cli_curso'] ?></td>
                        <td><a href="altera_clientes.php?id=<?= $tbl[0] ?>"><input type="button" value="CLIQUE PRA  ALTERAR"> </a></td>
                        <td><?= $check = ($tbl[3] == "s") ? "NÃO" : "SIM" ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
