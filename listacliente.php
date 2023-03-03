<?php
    include("conectadb.php");

    $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
    $resultado = mysqli_query($link, $sql);

    $ativo = 's';
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $ativo = $_POST['ativo'];

        if($ativo == 's'){
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 's'";
            $resultado = mysqli_query($link, $sql);
        }
        else{
            $sql = "SELECT * FROM clientes WHERE cli_ativo = 'n'";
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
    <title>Document</title>
    <link rel="stylesheet" href="newestilo.css">
</head>
<body>
<a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <form action="listacliente.php" method="post" class="ativos">
            <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo=='s'?"checked":""?>>ATIVO <br>
            <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo=='n'?"checked":""?>>DESATIVO
    </form>
    <div class="container">
        
        <table border="1">
            <tr>

                <th>ID</th>
                <th>CPF</th>
                <th>NOME</th>
                <th>DATA NASCIMENTO</th>
                <th>TELEFONE</th>
                <th>LOGRADOURO</th>
                <th>NUMERO</th>
                <th>CIDADE</th>
                <th>ALTERAR</th>
                <th>DISPONIVEL</th>
                
            </tr>
            <?php
                while ($tbl = mysqli_fetch_array($resultado)){
                    ?>
                    <tr>
                        <td><?= $tbl[0]?></td>
                        <td><?= $tbl[1]?></td>
                        <td><?= $tbl[2]?></td>
                        <td><?= $tbl[3]?></td>
                        <td><?= $tbl[4]?></td>
                        <td><?= $tbl[5]?></td>
                        <td><?= $tbl[6]?></td>
                        <td><?= $tbl[7]?></td>
                        
                        

                        <!-- traz somente a coluna id para apresentar na tabela-->
                        <!-- Ao clicar no botão ele já trará o id do usuario para a página do alterar -->
                        <td><a href="alteracliente.php?id=<?= $tbl[1]?>"><input type="button" value="ALTERAR"></a></td>

                        <td><?= $check = ($tbl[7] == "s")?"SIM":"NÃO"?></td>
                        
                    </tr>
                    <?php
                }
            ?>
        </table>
    </div>
</body>
</html>