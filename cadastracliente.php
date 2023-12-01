<?php
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $datadesc = $_POST['datadesc'];
    $telefone = $_POST['telefone'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) 
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 

        
    // Verifica se o CPF já está cadastrado
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    $cont = 0;
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }

    if ($cont > 0) {
        echo "<script>window.alert('CPF já cadastrado!');</script>";
    } else {
        $salsa = md5(rand() . date('H:i:s'));
        $senha = md5($senha . $salsa);

        $sql = "INSERT INTO clientes (cli_cpf, cli_nome, cli_senha, cli_datadesc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo, cli_salsa, cli_email, cli_recupera) 
        VALUES($cpf, '$nome', '$senha', '$datadesc', $telefone, '$logradouro', '$numero', '$cidade', 's', '$salsa', '$email', 0)";
        mysqli_query($link, $sql);

        echo "<script>window.alert('Cliente cadastrado com sucesso!');</script>";
        echo "<script>window.location.href='cadastracliente.php';</script>";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/stylesadm.css">
    <title>CADASTRO DE CLIENTE</title>
</head>
<body>
<div>
    <form action="cadastracliente.php" method="post">
        <input type="text" name="nome" id="nome" placeholder="Nome do Cliente">
        <p></p>
        <input type="text" name="cpf" id="cpf" placeholder="CPF">
        <p></p>  
        <input type="date" name="datadesc" id="datadesc" placeholder="Data de Nascimento">
        <p></p>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone">
        <p></p>
        <input type="text" name="email" id="email" placeholder="Email">
        <p></p>
        <input type="text" name="logradouro" id="logradouro" placeholder="Logradouro">
        <p></p>
        <input type="text" name="numero" id="numero" placeholder="Número">
        <p></p>
        <input type="text" name="cidade" id="cidade" placeholder="Cidade">
        <p></p>
        <input type="password" name="senha" id="senha" placeholder="Senha">
        <p></p>
        <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
    </form>
</div>
</body>
</html>
