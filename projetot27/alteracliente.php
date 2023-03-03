<?php 
    include("conectadb.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $cli_cpf = $_POST['cpf'];
        $cli_nome = $_POST['nome'];
        $cli_datanasc = $_POST['datanasc'];
        $cli_telefone = $_POST['telefone'];
        $cli_logradouro = $_POST['logradouro'];
        $cli_numero = $_POST['numero'];
        $cli_cidade = $_POST['cidade'];
        $cli_ativo = $_POST['ativo'];
        

        $sql = "UPDATE clientes SET cli_cpf = '$cpf', cli_nome = '$nome', cli_datanasc = '$datanasc', cli_telefone = '$cli_telefone', cli_logradouro = '$logradouro', cli_numero = '$numero', cli_cidade = '$cidade'";
        mysqli_query($link, $sql);
        header("Location: listacliente.php");
        echo"<script>window.alert('Cliente alterado com Sucesso!');</script>";
        exit();

    }
    $cli_id = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE cli_id = '$id";
    $resultado = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $cpf = $tbl[1];
        $nome = $tbl[2];
        $datanasc = $tbl[3];
        $telefone = $tbl[4];
        $logradouro = $tbl[5];
        $numero = $tbl[6];
        $cidade = $tbl[7];
        $ativo = $tbl[8];
    }

?>

<!DOCTYPE html>
<html lang="pt-bt">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ALTERAR CLIENTE</title>
        <link rel="stylesheet" href="newestilo.css">
    </head>
    <body>

        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>

        <div>
            <form action="alteracliente.php" method="POST">
            <label>CPF</label>
            <input type="text" name="cpf" value="<?=$cpf?>" disabled>
            <label>NOME</label>
            <input type="text" name="nome" value="<?=$nome?>" required>
            <label>DATA NASCIMENTO</label>
            <input type="text" name="datanasc" value="<?=$datanasc?>" required>
            <label>TELEFONE</label>
            <input type="text" name="telefone" value="<?=$telefone?>" required>
            <label>LOGRADOURO</label>
            <input type="text" name="logradouro" value="<?=$logradouro?>" required>
            <label>NUMERO</label>
            <input type="text" name="numero" value="<?=$numero?>" required>
            <label>CIDADE</label>
            <input type="text" name="cidade" value="<?=$cidade?>" required>
            <br><br>

            <label>Status: <?=$check = ($ativo == 's')? "ATIVO": "DESATIVO"?></label>
            <br>
            <input type="radio" name="ativo" value="s" <?=$ativo == "s"? "checked":""?>>ATIVO<br>
            <input type="radio" name="ativo" value="n"<?=$ativo == "n"? "checked":""?>>INATIVO
            <input type="submit" value="SALVAR">

            </form>
        </div>
        
    </body>
</html>