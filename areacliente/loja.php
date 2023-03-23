<?php
#Traz arquivo de conexão do banco
include("../conectadb.php");

session_start();
#Carrega a Página trazendo produtos com s (Produtos ATIVOS)
$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$resultado = mysqli_query($link, $sql);
#Atribui s para variavel ativo
$ativo = "s";


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loja.css">
    <title>LOJA</title>
</head>

<body>
    <!-- COLETA NOME DO USUARIO NA VARIAVEL DE SESSÃO-->
    <!-- style="background-color: #5c3666; border:5px solid; -->
    <h1>BOM DIA, <?= $_SESSION['nomecliente']; ?>!</h1>



    <nav>
        <a href="../cadastracliente.php"><input type="button" id="cadastracliente" value="CADASTRAR"></a>
        <a href="./logincliente.php"><input type="button" id="logincliente" value="LOGIN"></a>
    </nav>



    <form action="loja.php" id="loja" method="post">

        <div class="container">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>DESCRIÇÃO</th>      
                    <th>PRECO</th>
                    <th>IMAGEM</th>
                    <th>VER PRODUTO</th>


                </tr>
                <?php
                #Preenchimento da tabela com os dados do banco
                while ($tbl = mysqli_fetch_array($resultado)) {
                ?>
                    <tr>
                        <td><?= $tbl[0] ?></td>
                        <td><?= $tbl[4] ?></td>
                        <td><?= $tbl[1] ?></td>
                        
                        <!-- linha abaixo converte formato da $tbl[3] usando 2 casas após a virgula e aplicando , ao lugar de ponto -->
                        <td>R$ <?= number_format($tbl[3], 2, ',', '.') ?></td>
                        <td><img src="data:image/jpeg;base64,<?= $tbl[6] ?>" alt="imagem" width="100px" height="100px"></td>

                        <td style="display: flex; margin-top: 25px;"><a href="verproduto.php?id=<?= $tbl[0] && $tbl[2] ?>"><input type="button" value="VER PRODUTO"></a></td>

                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </form>

</body>

</html>