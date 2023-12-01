<?php
#INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho4.php");

#COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $sala = $_POST['sala'];
    $curso = $_POST['curso'];
    


    #PASSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE CLIENTE EXISTE
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }
    #VERIFICAÇÃO SE CLIENTE EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont > 0) {
        echo "<script>window.alert('CLIENTE JÁ CADASTRADO!');</script>";
    } else {
        #adicionar a salsa
       // $salsa = md5(rand() . date('H:i:s'));
        //$senha = md5($senha . $salsa);


        $sql = "INSERT INTO clientes (cli_nome, cli_email, cli_telefone, cli_sala, cli_curso, cli_status, cli_salsa) 
        VALUES('$nome', '$email', '$telefone', '$sala', '$curso', 's', '$salsa')";
        mysqli_query($link, $sql);

        echo($sql);

        echo "<script>window.alert('CLIENTE CADASTRADO');</script>";
        echo "<script>window.location.href='cadastrocliente.php';</script>";
    }
}
?>



<html>
<head>
    <link rel="stylesheet" type="text/css" href="cli.css">
    <title> CADASTRO DE CLIENTE</title>
</head>
<body><br><br><br><br><br>
<div>
    <form action="cadastrocliente.php" method="post">
            <h3>CADASTRA AQUI!!</h3>
        <input type = "text" name = "nome" id = "nome" 
        placeholder="nome de cliente">
        <p></p>
        <input type="text" name="cpf" id="cpf" placeholder="CPF">
        <p></p>
        <input type="text" name="email" id="email" placeholder="Email">
        <p></p>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone">
        <p></p>
        <input type="text" name="curso" id="curso" placeholder="Curso">
        <p></p>
        <input type="text" name="sala" id="sala" placeholder="Sala">
        <p></p>
        <input type = "submit" name = "cadastrar" id = "cadastrar" 
        placeholder="Cadastrar">

    </form>

</div>
</body>
</html>