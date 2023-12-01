<?php
include("cabecalho.php");
//COLETA DADIS DI GET
    $id = $_GET['var1'];
    $quantidade = $_GET['var2'];
    // ATUALIZA A QUANTIDADE DO ITEM NO BANCO DE DADOS
$sql = "UPDATE item_carrinho SET car_item_quantidade = $quantidade WHERE fk_pro_id = $id";
#ECHO SQL
$resultado = mysqli_query($link, $sql);
#retorna para o carrinho
header("Location: carrinho.php?id=$idusuario");