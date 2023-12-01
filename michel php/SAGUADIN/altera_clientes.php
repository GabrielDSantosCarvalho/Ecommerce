<?php
    #INICIA A CONEXÃO COM O BANCO DE DADOS
    include("cabecalho4.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $status = $_POST['status'];
        $senha = $_POST['senha'];

        #busca o tempero 
       # $sql = "SELECT cli_salsa FROM username WHERE cli_nome = '$nome'";
       # $retorno = mysqli_query($link, $sql);
       # while ($tbl = mysqli_fetch_array($retorno)) {
       #    $tempero = $tbl[0];
       # }

       #CASO O SENHA TENHA SIDO MODIFICADO
       #if( $senha != $senha2)
      # {
      #   $senha = md5($senha . $salsa );
      # }

       $sql = "UPDATE clientes SET cli_senha = '$senha', cli_nome = '$nome', cli_status = '$status' WHERE cli_id = $id";

       mysqli_query($link, $sql);

       echo "<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
       echo "<script>window.location.href='listecliente.php';</script>";
       exit();
    }






    $id = $_GET['id']; 
    $sql = "SELECT * FROM clientes WHERE cli_id = '$id'";
    $retorno = mysqli_query($link, $sql);

    while ($tbl = mysqli_fetch_array($retorno)) {
        $nome = $tbl[1]; 
        $senha = $tbl[2]; 
        $status = $tbl[3]; 
        $salsa = $tbl[4]; 
        $senha2 = $senha; 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="cli.css">
    <title>altera cliente</title>
</head>
<body>
    <div>
        <form action="altera_clientes.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME:</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>SENHA:</label>
            <input type="password" name="senha" value="<?= $senha ?>" required>
            <p></p>
            <label>STATUS: <?= $check = ($status == 'n') ? "ATIVO" : "INATIVO" ?></label>
            <p></p>
            <input type="radio" name="status" value="n" <?= $status == "n" ? "checked" : "" ?>>ATIVO<br>
            <input type="radio" name="status" value="s" <?= $status == "s" ? "checked" : "" ?>>INATIVO<br>
            <br>
            <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>