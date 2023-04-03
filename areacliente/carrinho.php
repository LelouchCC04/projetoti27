<?php
#TRAZER CONEXÃO DO BANCO
include("../conectadb.php");

#INICIA A SESSÃO JÁ ABERTA
session_start();
$idcliente = $_SESSION['idcliente'];
$finalizada = 'n';
#LISTA TODOS OS PRODUTOS DO CARRINHO
$sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id  FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 'n'";
$resultado = mysqli_query($link, $sql);

#SELETOR DE CARRINHO FINALIZADO OU NÃO
if($_SERVER['REQUEST_METHOD']== 'POST'){
    #RECEBE ESCOLHA DO HTML SELETOR (RADIO BUTTON)
    $finalizada = $_POST['finalizada'];
    if($finalizada == 'n'){
        $sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 'n'";
        $resultado = mysqli_query($link, $sql);
    }
    else{
        $finalizada == 's';
        $sql = "SELECT numero_carrinho, pro_nome, pro_descricao, pro_preco, item_quantidade, valor_carrinho, imagem1, carrinho_id  FROM itens_carrinho INNER JOIN clientes ON fk_cli_id = cli_id INNER JOIN produtos ON fk_pro_id = pro_id WHERE cli_id = $idcliente AND carrinho_finalizado = 's'";
        $resultado = mysqli_query($link, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../newestilo.css">
    <title>CARRINHO DO CLIENTE</title>
</head>
<body>
    <a href="loja.php"><input type="button" id="loja" value="VOLTAR PARA A LOJA"></a>
    <form action = "carrinho.php" method="post">
        <input type="radio" name="finalizada" value='s' onclick="submit()" <?= $finalizada == 's'? "checked" : "" ?>>COMPRAS FINALIZADAS
        <br>
        <input type="radio" name="finalizada" value='n' onclick="submit()" <?= $finalizada == 'n'? "checked" : "" ?>>CARRINHOS ABERTOS
    </form>
    <div class="container">
        <a href="finalizavenda.php?id=<?= $tbl[0]?>">
        <input type="button" value="FINALIZAR VENDA"></a>

        <table border="1">
            <tr>
                <th>NUMERO DO CARRINHO</th>
                <th>NOME PRODUTO</th>
                <th>DESCRICAO</th>
                <th>PRECO UNITÁRIO</th>
                <th>QUANTIDADE PRODUTOS</th>
                <th>IMAGEM</th>
            </tr>
            <?php
                while($tbl = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?= $tbl[0]?></td>
                        <td><?= $tbl[1]?></td>
                        <td><?= $tbl[2]?></td>
                        <td>R$ <?= number_format($tbl[3],2,',','.')?></td>
                        <td><?= $tbl[4]?></td>
                        <td><img src="data:image/jpeg;base64,<?= $tbl[6]?>" width="100" height="100"></td> 
                        
                        <td><a href="excluirproduto.php?id=<?=$tbl[7]?>">
                        <input type="button" value="REMOVER ITEM"></a></td>
                    </tr>
                    <?php
                }
                ?>        
        </table>
    </div>
    
</body>
</html>