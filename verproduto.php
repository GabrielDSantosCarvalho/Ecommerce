<?php
    include("cabecalho.php");
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $id = $_POST['id'];
        $nomeproduto = $_POST['nomeproduto'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $quantidade = (int)$quantidade;
        $valor = $_POST['valor'];
        $valor = (float)$valor;
        $totalitem = $_POST['valor'];
        #GERAR IMAGEM PARA DEFINIR UM CARRINHO UNICO E EXCLUSIVO
        $numerocarrinho = ($idusuario . RAND());
       
        #VALIDACAO CLIENTE LOGADO
        if ($idusuario <= 0 ){
            echo "<script>window.alert('VOCE PRECISA FAZER LOGIN PARA ADICIONAR ALGUM ITEM AO CARRINHO!);</script>";
            echo "<script>window.location.href='loja.php';</script>";
        }else{
            #VERIFICA SE EXISTE UM CARRINHO JA ABERTO
            $sql = "SELECT COUNT(car_id) FROM carrinho INNER JOIN clientes ON fk_cli_id = cli_id WHERE cli_id = $idusuario AND car_finalizado = 'n'";
 
            $retorno = mysqli_query($link,$sql);
            while($tbl = mysqli_fetch_array($retorno)){
                $cont = $tbl[0];
 
                    if($cont == 0){
                        $valor_venda = $quantidade= $valor;
 
                        #SE O CARRINHO NAO EXISTE GERA UM NOVO CARRINHO PARA ADICIONAR MAIS ITENS
                        $sql = "SELECT car_id FROM carrinho WHERE fk_cli_id =$idusuario AND car_finalizado = 'n'";
                        $retorno = mysqli_query($link, $sql);
                       
 
                        while($tbl = mysqli_fetch_array($retorno)){
                            $numerocarrinhocliente = $tbl[0];
                            $_SESSION['carrinhoid'] = $numerocarrinhocliente;
 
                            #VERIFICA SE JA EXISTE ESSE ITEM NO CARRINHO, SE JA EXISTE,  ATUALIZA A QUANTIDADE
                            $sql2 = "SELECT car_item_quantidade FROM item_carrinho WHERE fk_car_id ='$numerocarrinhocliente' AND fk_pro_id = $id";
                            $retorno2 = mysqli_query($link,$sql2);
                            $qtd_atual = mysqli_fetch_array($retorno2);
                            if($retorno2){
                                if(mysqli_num_rows($retorno2)>=1){
                                    $sql = "UPDATE item_carrinho SET car_item_quantidade = ($quantidade+$qtd_atual[0]) WHERE fk_car_id = '$numerocarrinhocliente' AND fl_pro_id $id";
                                    mysqli_query($link,$sql);
                                    echo"<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                                   // echo"<script>window,location.href='loja.php';</script>";
                                }
                                #SE JA EXISTE, ADICIONA O NOVO ITEM
                                else{
                                    $sql = "INSERT INTO 'item_carrinho'('fk_car_id', 'fk_pro_id', 'car_item_quantidade') VALUES ('$numerocarrinhocliente','$id',$quantidade)";
                                    mysqli_query($link,$sql);
                                    echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                                    //echo "<script>window.location.href='loja.php';</script>";
                                }
                            }
                        }
                    }
            }
        }
       // echo"<script>window.location.href='loja.php';</script>";
        exit();
 
    }
    $id = $_GET['id'];
    $sql = "SELECT *FROM produtos WHERE pro_id = $id";
    $retorno = mysqli_query($link,$sql);
 
    while($tbl=mysqli_fetch_array($retorno)){
        $id = $tbl[0];
        $nomeproduto = $tbl[1];
        $descricao = $tbl[2];
        $valor = $tbl[4];
        $imagem_atual = $tbl[6];
    }
 
    #CORAÇÃOZINHO DO FAVORITOS
    if(isset($idusuario)){
    $sql = "SELECT COUNT(fav_id) FROM favoritos WHERE fav.cli_id = $idusuario AND fav_pro_id = $id";
    }
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/ver.css">
        <title>Ver Produto</title>
    </head>
    <body>
    <div class="formulario">
            <form class="visualizaproduto" action="verproduto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>" readonly>
                <label>NOME</label>
                <input type="text" name="nomeproduto" id="nome" value="<?= $nomeproduto ?>" readonly>
                <label>DESCRIÇÃO</label>
                <textarea name="descricao" readonly <?= $descricao ?>></textarea>
                <label>QUANTIDADE</label>
                <input type="number" name="quantidade" id="quantidade" min="1" value="1">
                <label>PREÇO</label>
                <input type="decimal" name="valor" id="valor" value="R$ <?= $valor ?>" readonly>
                <input type="submit" value="ADICIONAR AO CARRINHO">
   
            </form>
        </div>
        <div style="position: relative;">
        <a href="favoritar.php?id=<?= $id ?>" style="position: absolute; top: 0; left: 0;">
    </a>
        <td><img name="imagem_atual" class="imagem_atual" src="<?= $imagem_atual ?>"></td>
    </div>
    </body>
    </html>