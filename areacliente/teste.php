<?php

    include("../conectadb.php");

    #BUSCA A VARIAVEL DE SESSÃO DO USUARIO
    session_start();
    $idcliente = $_SESSION['idcliente'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idproduto = $_POST['idproduto'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $totalparcial = ($preco * $quantidade);
        
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
                echo "<script>window.location.href='loja.php';</script>";

            }
            else{
                #VERIFICA QUAL É O NUMERO DO CARRINHO DO MELIANTE
                $sql = "INSERT DISTINCT(numero_carrinho) FROM itens_carrinho WHERE fk_cli_id = '$idcliente' AND carrinho_finalizado = 'n'";
                $resultado2 = mysqli_query($link, $sql);
                while ($tbl = mysqli_fetch_array($resultado2)){
                    $numerocarrinhocliente = $tbl2[0];
                    $tbl = "INSERT INTO itens_carrinho(fk_pro_id, fk_cli_id, item_quantidade, valor_carrinho, numero_carrinho, carrinho_finalizado) VALUES('$idproduto', '$idcliente', '$quantidade', '$totalparcial', '$numerocarrinhocliente', 'n')";
                    mysqli_query($link, $sql);

                    echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                    echo "<script>window.location.href='loja.php';</script>";

                }
            }
        }
    }

    
    $idproduto = $_GET['id'];
    $sql = "SELECT * FROM produtos WHERE pro_id = '$idproduto'";
    $resultado = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($resultado)){
        $nomeproduto = $tbl[1];
        $descricao = $tbl[2];
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
            <input type="text" name="nome" value="<?=$nomeproduto?>" required><br>
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricao" value="<?=$descricao?>" required><br>
            <label>QUANTIDADE</label>
            <input type="number" name="quantidade" required><br>
            <label>PREÇO</label>
            <input type="decimal" name="preco" value="<?=$preco?>" required disabled><br>

            <img src="data:image/jpeg;base64,<?= $imagematual ?>" width="150" height="150">
            <br><br>

            <input type="submit" value="ADICIONAR AO CARRINHO">
        </form>
    </div>
        


    </body>
</html>