<?php
include("cabecalho.php");

$sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
$retorno = mysqli_query($link, $sql);
$ativo = "s";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];

    if ($ativo == "all") {
        $sql = "SELECT * FROM produtos";
    } else if ($ativo == 's') {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
    } else {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
    }

    $retorno = mysqli_query($link, $sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    <link rel="stylesheet" href="./css/loja1.css">
</head>

<body class="preto">
    <div id="background">

        <div class="container">
            <div class="product-list">
                <?php
                if (mysqli_num_rows($retorno) > 0) {
                    while ($tbl = mysqli_fetch_array($retorno)) {
                ?>
                        <div class="product">
                            <img src="<?= $tbl['pro_img'] ?>" alt="Imagem do Produto">
                            <h2><?= $tbl['pro_nome'] ?></h2>
                            <p><?= $tbl['pro_desc'] ?></p>
                            <!-- <p>Quantidade: <= $tbl['pro_quant'] ?></p> -->
                            <p>Valor: R$<?= $tbl['pro_valor'] ?></p>
                            <form method="post" action="verproduto.php">
                                <input type="hidden" name="produto_id" value="<?= $tbl['pro_id'] ?>">
                                <!-- <label for="quantidade">Quantidade:</label>
                                 <input type="number" id="quantidade" name="quantidade" min="1" max=" //$tbl['pro_quant'] ?>" value="1"> -->
                                <a href="verproduto.php?id=<?= $tbl[0] ?>" class="produto-link">
                                    <input type="button" class="produto-button" value="Visualizar o Carrinho"></a>
                            </form>
                        </div>
                <?php
                    }
                } else {
                    echo "<p>Nenhum produto encontrado.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>