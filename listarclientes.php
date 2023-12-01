<?php
# Inclua o arquivo de cabeçalho
include("cabecalho.php");

# Defina a variável $ativo como 's' por padrão
$ativo = "s";

# Verifique se a solicitação é um POST e atualize a variável $ativo de acordo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];
}

# Construa a consulta SQL com base na variável $ativo
if ($ativo == 's') {
    $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
} else {
    $sql = "SELECT * FROM clientes WHERE cli_ativo = 'n'";
}

# Execute a consulta
$retorno = mysqli_query($link, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE CLIENTES</title>
    <link rel="stylesheet" href="./css/stylesadm.css">
</head>

<body>
    <div id="background">
        <form action="listarclientes.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == "s" ? "checked" : "" ?>>ATIVOS
            <br>
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == "n" ? "checked" : "" ?>>INATIVOS
            <br>
            <br>
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>NOME</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO</th>
                </tr>
                <?php
                while ($tbl = mysqli_fetch_array($retorno)) {
                ?>
                    <tr>
                        <td><?= $tbl[1] ?></td>
                        <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"> </a></td>
                        <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
