<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cli_cpf = $_POST['cpf'];
        $cli_nome = $_POST['nome'];
        $cli_datanasc = $_POST['datanasc'];
        $cli_telefone = $_POST['telefone'];
        $cli_logradouro = $_POST['logradouro'];
        $cli_numero = $_POST['numero'];
        $cli_cidade = $_POST['cidade'];
        

        include("conectadb.php");

        $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_cpf = '$cli_cpf'";
        $resultado = mysqli_query($link, $sql);

        while ($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }

        if ($cont == 1){

            echo "<script>window.alert('CPF INEXISTENTE/ERRADO');</script>";
        }
        else{
            $sql = "INSERT INTO clientes(cli_cpf, cli_nome, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade) VALUES ('$cli_cpf', '$cli_nome', '$cli_datanasc', '$cli_telefone', '$cli_logradouro', '$cli_numero', '$cli_cidade')";

            mysqli_query($link, $sql);
            header("location: listacliente.php");
        }


    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CADASTRA CLIENTE</title>
        <link rel="stylesheet" href="newestilo.css">
    </head>
    <body>
        <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>

        <div>
            <form action="cadastracliente.php" method="POST">

                <h1>CADASTRAR CLIENTE</h1>

                <input type="number" name="cpf" id="cpf" placeholder="INSIRA SEU CPF" required>
                <br><br>
                <input type="text" name="nome" id="nome" placeholder="INSIRA SEU NOME" required>
                <br><br>
                <input type="number" name="datanasc" id="datanasc" placeholder="INSIRA SUA DATA DE NACIMENTO" required>
                <br><br>
                <input type="number" name="telefone" id="telefone" placeholder="INSIRA SEU TELEFONE" required>
                <br><br>
                <input type="text" name="logradouro" id="logradouro" placeholder="INSIRA SEU LOGRADOURO(ENDEREÇO)" required>
                <br><br>             
                <input type="number" name="numero" id="numero" placeholder="INSIRA SEU NÚMERO" required>
                <br><br>
                <input type="text" name="cidade" id="cidade" placeholder="INSIRA SUA CIDADE " required>
                <br><br>

                <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">
            </form>
        </div>
        
    </body>
</html>