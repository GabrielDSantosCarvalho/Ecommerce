<?php
 
include("cabecalho4.php");
 
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];
 
    $sql = "SELECT COUNT(usu_id) FROM usuarios
        WHERE usu_email = '$email'
        AND usu_senha = '$senha' AND usu_status = 's'";
   
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $resultado = $tbl[0];
    }
     ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tabel_log (tab_query, tab_data)
    VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
    if ($resultado == 0){
        echo"<script>window.alert('USUARIO INCORRETO');</script>";
    }
    else{
        $sql = "SELECT * FROM usuarios
        WHERE usu_email = '$email'
        AND usu_senha = '$senha'
        AND usu_status = 's'";
    $retorno = mysqli_query($link,$sql);
    ##GRAVA LOG
    $sql ='"'.$sql.'"';
    $sqllog ="INSERT INTO tabel_log (tab_query, tab_data)
    VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
 
       }
        echo"<script>window.location.href='backoffice.php';</script>";
    }
 

 
?>