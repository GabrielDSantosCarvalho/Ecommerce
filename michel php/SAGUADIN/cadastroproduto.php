<?php
    include("cabecalho4.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $desc = $_POST['desc'];
        $custo = $_POST['custo'];
        $preco = $_POST['preco'];
        $quant = $_POST['quant'];
        $val = $_POST['val'];
        $for_id = $_POST['fornecedor'];

        $sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome'";
        $retorno = mysqli_query($link, $sql);
        $cont = (mysqli_fetch_array($retorno)[0]);

        if ($cont == 0) {
            $sql = "INSERT INTO produtos(pro_nome, pro_desc, pro_custo, pro_preco, pro_quant, pro_val, pro_status, fk_for_id) 
            VALUES('$nome', '$desc', '$custo', $preco, $quant, '$val', 's', $for_id)";
            
            mysqli_query($link, $sql);
            echo"<script>window.alert('PRODUTO CADASTRADO COM SUCESSO');</script>";
            echo"<script>window.location.href='cadastroproduto.php';</script>";
        }
        else {
            echo"<script>window.alert('PRODUTO JÁ EXISTENTE');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="cli.css">
    <title>Cadastra Produto</title>
</head>
<body> <br><br><br><br><br>
    <div id="container">
        <form action="cadastroproduto.php" method="post">
            <label>NOME PRODUTO</label>
            <input type="text" name="nome" id="nome">
            <label>DESCRIÇÃO</label>
            <textarea type="text" name="desc" id="desc"></textarea>
            <label>CUSTO</label>
            <input type="number" step="0.01" name="custo" id="custo">
            <label>PREÇO</label>
            <input type="decimal" name="preco" id="preco">
            <label>QUANTIDADE</label>
            <input type="number" step="0.01" name="quant" id="quant">
            <label>VALIDADE</label>
            <input type="date" name="val" id="val">
            
            <select name="fornecedor" id="fornecedor" required>
                <?php 

                $sql = "SELECT for_id, for_nome FROM fornecedor";
                $retorno = mysqli_query($link, $sql);

                while($tbl = mysqli_fetch_array($retorno)) {
                    
                   
                
                ?>
                <option value="<?=$tbl[0]?>"><?=$tbl[1]?></option>
                <?php 
                }
                ?>
            </select><br>
            
                <input type="submit" name="cadastrar" value="CADASTRAR">
        </form>
    </div>
</body>
</html>