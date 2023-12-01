<?php
    #INICIA A CONEXÃO COM O BANCO DE DADOS
    include("cabecalho.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST")  {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $ativo = $_POST['ativo'];
        $senha = $_POST['senha'];

        #busca o tempero 
       # $sql = "SELECT usu_salsa FROM username WHERE usu_nome = '$nome'";
       # $retorno = mysqli_query($link, $sql);
       # while ($tbl = mysqli_fetch_array($retorno)) {
       #    $tempero = $tbl[0];
       # }

       #CASO O SENHA TENHA SIDO MODIFICADO
       #if( $senha != $senha2)
      # {
      #   $senha = md5($senha . $salsa );
      # }

       $sql = "UPDATE username SET usu_senha = '$senha', usu_nome = '$nome', usu_ativo = '$ativo' WHERE usu_id = $id";

       mysqli_query($link, $sql);

       echo "<script>window.alert('USUÁRIO ALTERADO COM SUCESSO!');</script>";
       echo "<script>window.location.href='listadeusuario.php';</script>";
       exit();
    }





    #COLETANDO OS DADOS PASSADOS VIA GET 
    $id = $_GET['id']; #COLETANDO O ID DO USUARIO APÓS TER SIDO CLICADO NA LISTA USUARIO
    $sql = "SELECT * FROM username WHERE usu_id = '$id'";
    $retorno = mysqli_query($link, $sql);

    while ($tbl = mysqli_fetch_array($retorno)) {
        $nome = $tbl[1]; #CAMPO DE NOME
        $senha = $tbl[2]; #CAMPO DE SENHA
        $ativo = $tbl[3]; #CAMPO DE ATIVO
        #$salsa = $tbl[4]; #CAMPO DE SALSA
        $senha2 = $senha; #CAMPO SENHA2 PARA VERIFICAR SE FOI FEITA ALGUMA ALTERAÇÃO
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/stylesadm.css">
    <title>altera usuario</title>
</head>
<body>
    <div>
        <form action="alterausuario.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME:</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>SENHA:</label>
            <input type="password" name="senha" value="<?= $senha ?>" required>
            <p></p>
            <label>STATUS: <?= $check = ($ativo == 's') ? "ATIVO" : "INATIVO" ?></label>
            <p></p>
            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>ATIVO<br>
            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>INATIVO<br>
            <br>
            <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>