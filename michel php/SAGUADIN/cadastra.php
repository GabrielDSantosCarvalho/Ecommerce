<?php
include("cabecalho4.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $login = $_POST['login'];
 
    $key = RAND(100000, 999999);
 
    #INSERIR INSTRUÃ‡Ã•ES NO BANCO
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' OR usu_login = '$login'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado)[0];
 
 
    #VERIFICA SE EXISTE
    if ($contagem >= 1) {
        echo "<script>window.alert('EMAIL JA CADASTRADO');</script>";
    } else {
        $sql = "INSERT INTO usuarios(usu_login, usu_senha, usu_status, usu_key, usu_email)
         VALUES ('$login', '$senha', 's', '$key', '$email')";
        mysqli_query($link, $sql);
 
        echo "<script>window.alert('USUARIO CADASTRADO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}