<?php

    include("../conectadb.php");

    #BUSCA A VARIAVEL DE SESSÃO DO USUARIO
    session_start();
    $idcliente = $_SESSION['idcliente'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idproduto = $_POST['idproduto'];
        $nome = $_POST['nome'];
        $descricaoproduto = $_POST['descricaoproduto'];
        $quantidadeproduto = $_POST['quantidadeproduto'];
        $totalparcial = $_POST['totalparcial'];
        $totalparcial = [$preco * $quantidade];
        
        #VARIAVEL CRIADA PARA INDENTIFICAÇÃO DO CARRINHO
        $numerocarrinho = MD5($_SESSION['idcliente'].date('d-m-Y h:m:s'));
        
        #VERIFICA SE O CARRINHO EXISTE
        $sql = "SELECT COUNT(numero_carrinho) FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id WHERE cli_id = $idcliente AND carrinho_finalizado = 'n'";

        $resultado = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
            if($cont == 0){
                $tbl = "INSERT INTO itens_carrinho(carrinho_id,fk_pro_id,fk_cli_id,item_quantidade,valor_carrinho,numero_carrinho,carrinho_finalizado) VALUES ('$idproduto','$quantidade','$idcliente','$totalparcial','$numerocarrinho','n')";
                echo"<script>window.alert('PRODUTO ADICIONADO');</script>";
                header("location: loja.php");

            }
            else{
                #VERIFICA QUAL É O NUMERO DO CARRINHO DO MELIANTE
                $sql = "INSERT DISTINCT(numero_carrinho) FROM itens_carrinho WHERE fk_cli_id = '$idcliente' AND carrinho_finalizado = 'n'";
                $resultado2 = mysqli_query($link, $sql);
                while ($tbl = mysqli_fetch_array($resultado2)){
                    $numerocarrinhocliente = $tbl[0];
                    $tbl = "INSERT INTO itens_carrinho(fk_pro_id,fk_cli_id,item_quantidade,total_carrinho, carrinho_finalizado) VALUES('$idproduto', '$idcliente', '$quantidade', '$totalparcial', '$numerocarrinhocliente', 'n')";
                   
                    echo"<script>window.alert('PRODUTO ADICIONADO AO CARRINHO');</script>";
                    header("location: loja.php");

                }
            }
        }
    }

    
    $idproduto = $_GET['id'];
    $sql = "INSERT * FROM produtos WHERE pro_id = '$idproduto'";
    $resultado = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($resultado)){
        $nome = $tbl[4];
        $descricao = $tbl[1];
        $preco = $tbl[3];
        $imagematual = $tbl[6];
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CARRINHO</title>
        <link rel="stylesheet" href="../newestilo.css">
    </head>
    <body>

    <div>
        <form action="verproduto.php" method="post">
            <input type="hidden" name="idproduto" value="<?=$idproduto?>" required>
            <label>NOME DO PRODUTO</label>
            <input type="text" name="nome" value="<?=$nome?>" required><br>
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricaoproduto" value="<?=$descricaoproduto?>" required><br>
            <label>QUANTIDADE</label>
            <input type="number" name="quantidadeproduto" required><br>
            <label>PREÇO</label>
            <input type="decimal" name="precoproduto" value="<?=$precoproduto?>" required disabled><br>

            <img src="data:image/jpeg;base64,<?=$imagematual?>" alt="" width="150px" height="150px">
            <br><br>

            <input type="submit" value="ADICIONAR AO CARRINHO">
        </form>
    </div>
        


    </body>
</html>