<?php
include("conectadb.php");


// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
  
    $nome = $_POST["nome"];
    $descricao = $_POST["descricao"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $ativo = $_POST["ativo"];
    

    $sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) 
        $cont = $tbl[0];
        

    // Verifica se a imagem foi enviada
    if (isset($_FILES["imagem"]) && $_FILES["imagem"]["error"] == 0) {
        $imagem_nome = $_FILES["imagem"]["name"];
        $imagem_temp = $_FILES["imagem"]["tmp_name"];
        $upload_dir = "uploads";

        // Cria o diretório de uploads se não existir
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $imagem_destino = $upload_dir . $imagem_nome;

        // Move a imagem para o diretório de uploads
        if (move_uploaded_file($imagem_temp, $imagem_destino)) {
            // Mensagem de sucesso
            echo "<script>window.alert('PRODUTO CADASTRADO');</script>";
        } } else {

            $sql = "INSERT INTO produtos (pro_nome, pro_desc, pro_quant, pro_valor,  pro_ativo, pro_img)
            VALUES('$nome', '$descricao', '$quantidade', '$valor', '$imagem', 's')";
            mysqli_query($link, $sql);
            echo "<script>window.alert('PRODUTO CADASTRADO');</script>";
            echo "<script>window.location.href='cadastraproduto.php';</script>";
        
        }
    } else {
        $imagem_destino = null;
    }  
 
  
?>

<h2 align=center>Cadastre o Produto</h2>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="./css/estiloadm.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
 
    <form action="cadastraproduto.php" method="post" enctype="multipart/form-data">
       

        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" rows="4" required></textarea><br>

        <label for="quantidade">Quantidade:</label>
        <input type="number" name="quantidade" required><br>

        <label for="valor">Valor:</label>
        <input type="text" name="valor" required><br>

        <label for="ativo">Ativo:</label>
        <select name="ativo">
            <option value="1">Sim</option>
            <option value="0">Não</option>
        </select><br>

        <label for="imagem">Imagem:</label>
        <input type="file" name="imagem" accept="image/*"><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>




