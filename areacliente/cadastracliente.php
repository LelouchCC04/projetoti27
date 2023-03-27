<?php
    include("../conectadb.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $datanasc = $_POST['datanasc'];
        $telefone = $_POST['telefone'];
        $logradouro = $_POST['logradouro'];
        $numero = $_POST['numero'];
        $cidade = $_POST['cidade'];
        $ativo = $_POST['ativo'];
        $senha = $_POST['senha'];

        
        #VERIFICA SE CLIENTE ESTÁ CADASTRADO
        $sql ="SELECT COUNT(cli_id) from clientes WHERE cli_cpf = '$cpf'";
        $resultado = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }
        #Verificação visual se usuario existe ou não.
        if($cont == 1){
            echo"<script>window.alert('USUARIO JÁ CADASTRADO!');</script>";
        }
        else{
            $sql = "INSERT INTO clientes (cli_nome, cli_cpf, cli_senha, cli_datanasc, cli_telefone, cli_logradouro, cli_numero, cli_cidade, cli_ativo) VALUES('$nome','$cpf', '$senha',STR_TO_DATE('$datanasc','%Y-%m-%d'), '$telefone', '$logradouro','$numero','$cidade', 's')";// STR_TO_DATE('$datanasc_formatada','%Y-%m-%d')
            mysqli_query($link,$sql);
            // echo($datanasc);
            header("Location: logincliente.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="newestiloloja.css">
        <title>CADASTRAR CLIENTES</title>
    </head>

    <body>
        
        <div>

            <form action="cadastracliente.php" method="post">
                <h1>Cadastra-se</h1>
                <label>NOME</label>
                <input type="text" name="nome" required>
                <br></br>
                <label>CPF</label>
                <input type="number" name="cpf" required>
                <label>SENHA DE ACESSO</label>
                <input type="password" name="senha" required>
                <br></br>
                <label>DATA DE NASCIMENTO</label>
                <input type="date" name="datanasc">
                <br></br>
                <label>TELEFONE</label>
                <input type="number" name="telefone">
                <br></br>
                <label>LOGRADOURO</label>
                <input type="text" name="logradouro">
                <br></br>
                <label>NUMERO</label>
                <input type="text" name="numero">
                <br></br>
                <label>CIDADE</label>
                <input type="text" name="cidade">
                <br></br>
            
                <br>
                <input type="submit" value="CADASTRAR">

                <h2>Login</h2>
                <a href="./areacliente/logincliente.php"><input type="button" id="logincliente" value="LOGIN"></a>
            </form>
        
        </div>
    </body>
</html>