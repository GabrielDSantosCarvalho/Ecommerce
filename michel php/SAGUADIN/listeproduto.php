<?php
include("cabecalho4.php");

$sql = "SELECT * FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link, $sql);
$status = "s";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $_POST['status'];

    // if (isset($_POST['mostrar_todos'])) {
    //     $sql = "SELECT * FROM produtos";
    // } elseif ($status == 's') {
    //     $sql = "SELECT * FROM produtos WHERE pro_status = 's'";
    // } else {
    //     $sql = "SELECT * FROM produtos WHERE pro_status = 'n'";
    // }


    if ($status == "all") {
        $sql = "SELECT * FROM produtos";
    } elseif ($status == 's') {
        $sql = "SELECT * FROM produtos WHERE pro_status = 's'";
    } else {
        $sql = "SELECT * FROM produtos WHERE pro_status = 'n'";
    }

    $retorno = mysqli_query($link, $sql);
} 
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" type="text/css" href="cli.css">
</head>

<body>
    <div id="background">
        <form action="listeproduto.php" method="post">
            <input type="radio" name="status" class="radio" value="s" required onclick="submit()" <?= $status == "s" ? "checked" : "" ?>>Inativos
            <br>
            <input type="radio" name="status" class="radio" value="n" required onclick="submit()" <?= $status == "n" ? "checked" : "" ?>>Ativos
            <br>
            <input type="radio" name="status" class="radio" value="all" required onclick="submit()" <?= $status == "all"? "checked" : "" ?>>Mostrar Todos
            <br>
            <br>
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Custo</th>
                    <th>Validade</th>
                    <th>Quantidade</th>
                    <th>Ativo</th>  
                    <th>Alterar Dados</th>
                    
                    
                    
                </tr>
                
                 <?php
if (mysqli_num_rows($retorno) > 0) {
    while ($tbl = mysqli_fetch_array($retorno)) {
?>
        <tr>
            <td><?= $tbl['pro_nome'] ?></td>
            <td><?= $tbl['pro_desc'] ?></td>
            <td>R$: <?= $tbl['pro_preco'] ?></td>
            <td><?= $tbl['pro_custo'] ?></td>
            <td> <?= $tbl['pro_val'] ?></td>
            <td><?= $tbl['pro_quant'] ?></td>
            <td><?= $tbl['pro_status'] == 's' ? 'Não' : 'Sim' ?></td>
            <td><a href="alteraproduto.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"> </a> </td>
           
            

        </tr>
        
                       
<?php
    }
} else {
    echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
}
?>

            </table>
        </div>
    </div>
</body>
</html>
