<?php
# INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $desc = $_POST['descricao']; // Corrigido o nome do campo
    $quant = $_POST['quantidade']; // Corrigido o nome do campo
    $valor = $_POST['valor'];
    $ativo = $_POST['ativo'];
    $img = $_POST['img'];

    if ($_FILES['imagem']['tmp_name']) {
        $img_name = $_FILES['imagem']['name'];
        $destino = '' . $img_name;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            $sql = "UPDATE produtos SET pro_nome = '$nome', pro_desc = '$desc', pro_quant = '$quant', pro_valor = '$valor', pro_ativo = '$ativo', pro_img = '$img_name' WHERE pro_id = $id";
            mysqli_query($link, $sql);
        }
    } else {
        $sql = "UPDATE produtos SET pro_nome = '$nome', pro_desc = '$desc', pro_quant = '$quant', pro_valor = '$valor', pro_ativo = '$ativo' WHERE pro_id = $id";
        mysqli_query($link, $sql);
    }

    echo "<script>window.alert('PRODUTO ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='listaproduto.php';</script>";
    exit();
}

# COLETANDO OS DADOS PASSADOS VIA GET
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nome = $tbl[1];
    $desc = $tbl[2];
    $quant = $tbl[3];
    $valor = $tbl[4];
    $ativo = $tbl[5];
    $img = $tbl[6];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesadm.css">
    <title>altera produto</title>
</head>
<body>
    <div>
        <form action="alteraproduto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME:</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>VALOR:</label>
            <input type="text" name="valor" value="<?= $valor ?>" required>
            <p></p>
            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?= $desc ?>" required>
            <p></p>
            <label>Quantidade:</label>
            <input type="text" name="quantidade" value="<?= $quant ?>" required>
            <p></p>
            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>INATIVO<br>
            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>ATIVO<br>
            <br>
            <input type="file" name="imagem">
            <br>
            <input type="submit" value="SALVAR">
           
        </form>
      

       <img src="<?= $tbl['pro_img'] ?>">
    </div>
</body>
</html>
