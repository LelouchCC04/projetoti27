<?php
#abre conexão com o banco de dados
include("conectadb.php");

#passa a instrução para o bando de dados
#função da instrução: LISTAR TODOS O CONTEÚDO DA TABELA produtos
#CARREGA A PAGINA TRAZENDO PRODUTOS COM 's' (PRODUTO ATIVOS)
$sql = "SELECT * FROM produtos WHERE pro_ativo= 's'";
$resultado = mysqli_query($link, $sql);

#ATRIBUI 's' PARA VARIAVEL ATIVO
$ativo = 's';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $ativo = $_POST['ativo'];
    
    #Confere se o POST da pagina  foi 's' 
    #Se 's' traga produtos ativos senão traga inativo
    if ($ativo == 's'){
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's';";
        $resultado = mysqli_query($link, $sql);

    }
    else{
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n';";
        $resultado = mysqli_query($link, $sql);
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA PRODUTOS</title>
    <link rel="stylesheet" href="newestilo.css">


</head>

<body>
    <a href="cadastraproduto.php"><input type="button" id="cadastraproduto" value="CADASTRAR PRODUTO"></a>

    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>

    <!-- botoes que validam se o produto é listado somente ativos ou inativos -->
    <!-- onclick="subimit()" é um javascript que ja faz um subimit na pagina usando o navegador como recurso-->
    
    <form action="listaproduto.php" method="post">
            <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo=='s'?"checked":""?>>DISPONIVEL <br>
            <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo=='n'?"checked":""?>>INDISPONIVEL
    </form>

    <div class="container">
        
        <table border="1">
            <tr>
                <th>NOME</th>
                <th>ID</th>
                <th>DESCRIÇÃO</th>
                <th>QUANTIDADE</th>
                <th>PREÇO</th>
                <th>ALTERAR</th>
                <th>DISPONIVEL</th>
            </tr>
            <?php
                //Preencimento da tabela com os dados do banco 
                while ($tbl = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>                     
                        
                        <td><?= $tbl[4]?></td> <!-- NOME -->
                        <td><?= $tbl[0]?></td> <!-- ID -->
                        <td><?= $tbl[1]?></td> <!-- DESCRIÇÃO -->
                        <td><?= $tbl[2]?></td> <!-- QUANTIDADE -->
                        
                        <!-- linha abaixo convete formato da $tbl[3] usando 2 casas apos a virgula  -->
                        <td>R$ <?=number_format($tbl[3],2,',','.')?></td> <!-- PREÇO -->                     
                        
                        <td><a href="alteraproduto.php?id=<?= $tbl[0]?>"><input type="button" value="ALTERAR"></a></td>
                        <!-- tbl[5] verifica se o sim esta vindo do banco de dados. Se sim escreve SIM. senao escreva NÃO-->
                        <td><?= $check = ($tbl[5] == "s")?"SIM":"NÃO"?></td>                      
                    
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</body>

</html>