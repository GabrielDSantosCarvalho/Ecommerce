<?php
    include("conectadb.php");

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $valor = $_POST['valor'];
        $ativo = $_POST['ativo'];

        // Obtém o nome do arquivo de imagem e o caminho temporário do arquivo
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTemp = $_FILES['imagem']['tmp_name'];

        // Define o caminho para o diretório de imagens
        $caminhoImagem = "imagens" . $imagemNome;

        // Move o arquivo de imagem para o diretório desejado
        if (move_uploaded_file($imagemTemp, $caminhoImagem)) {
            // Insere os dados no banco de dados, incluindo o caminho da imagem
            $sql = "INSERT INTO produtos (pro_nome, pro_desc, pro_quant, pro_valor, pro_ativo, pro_img) 
                    VALUES ('$nome', '$descricao', '$quantidade', '$valor', '$ativo', '$caminhoImagem')";
        
            $retorno = mysqli_query($link, $sql);

            // Verifica se a inserção foi bem-sucedida
            if ($retorno) {
                echo "<script>window.alert('PRODUTO CADASTRADO!');</script>";
            } else {
                echo "Erro ao inserir dados: " . mysqli_error($link);
            }
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./estiloadm.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <div class="text">
    <h1 align=center>Cadastro de Produtos</h1>
    </div>
    <form method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" required><br>
        Descrição: <textarea name="descricao"></textarea><br>
        Quantidade: <input type="number" name="quantidade" required><br>
        Valor: <input type="number" name="valor" step="0.01" required><br>
        Ativo: <input type="checkbox" name="ativo" value="s" checked><br>
        Imagem: <input type="file" name="imagem" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
