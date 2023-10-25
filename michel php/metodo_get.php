<?php
##USANDO METHOD GET##
if(isset ($_GET ['login'])){
    echo $_GET ['login'];
    $login = $_GET ['login'];
}
if(isset($GET ['senha'])){
    echo $_GET ['senha'];
    $senha = $_GET ['senha'];
}
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="metodo_get.php" method="get">
        <input type="text" name="LOGIN" placeholder="LOGIN">
        <br>
        <input type="text" name="SENHA" placeholder="SENHA">
         <br>
        <input type="submit" value="RODAR">
    </form>
</body>
</html>