<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];


?>

<div>

<ul class="menu">

            <li><a href="cadastrausuario.php">CADASTRA USUÁRIO</a></li>
            <li><a href="cadastraproduto.php">CADASTRA PRODUTOS</a></li>
            <li><a href="listadeusuario.php">LISTA USUÁRIO</a></li>
            <li><a href="listaproduto.php">LISTA PRODUTO</a></li>
            <!--<li><a href="listaclientes.php">LISTAR CLIENTES</a></li>
            <li><a href="vendas.php">VENDAS</a></li>-->
            <li class="menuloja"><a href="logout.php">SAIR</a></li>

            <?php
                if($nomeusuario != null) {
                ?>
                    <li class="profile"> OLÁ  <?= strtoupper($nomeusuario) ?></li>
                    <?php
                } else {
                    ?>
                    <li class="profile"> OLÁ  <?= strtoupper($nomeusuario) ?></li>
                    <?php
                    echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO'); window.location.href='loginusuario.php';</script>"; 
                }
                ?>
            
</ul>
</div>