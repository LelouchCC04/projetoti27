<?php


session_start();
#CAPTURA VARIÁVEIS UTILIZANDO O MÉTODO POST
if($_SERVER['REQUEST_METHOD']=="POST"){
    $cpf = $_POST['cpf']; #captura varíavel que está no name="nome" html
    $password = $_POST['password']; #captura variável que está no name="password" html
    include("../conectadb.php"); #include chama a conexão com o banco de dados no script conectadb.php

    #CONSULTA SQL PARA VERIFICAR USUARIO CADASTRADO
    #instrução de comunicação com o banco de dados
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_cpf = '$cpf' AND cli_senha ='$password' AND cli_ativo = 's'";
    #coleta o valor da consulta e cria um array para armazenar
    $resultado = mysqli_query($link,$sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $cont = $tbl[0]; #armazena o valor da coluna no caso a [0]
    }
    #Verifica se o resultado do cont é 0 ou 1
    #Se 0 o cliario ou Senha estão incorretos
    if($cont==1){
        $sql = "SELECT * FROM clientes WHERE cli_cpf = '$cpf' AND cli_senha = '$password' AND cli_ativo = 's'";
        $resultado = mysqli_query($link, $sql);
        while($tbl = mysqli_fetch_array($resultado)){
            $_SESSION['idcliente'] = $tbl[0];
            $_SESSION['nomecliente'] = $tbl[2];
            

        }
        header("Location: loja.php"); #Se usuario e senha corretos, vá para homesistema
    }
    else{
        echo"<script>window.alert('CLIENTE OU SENHA INCORRETOS!');</script>"; # se incorreto apresenta o erro
    }
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN CLIENTE</title>
    <link rel="stylesheet" href="newestiloloja.css">

</head>
<body>
    

    <div class="container">
    <!-- script para mostrar senha-->
    <script>
        function mostrarsenha(){
            var tipo = document.getElementById("senha");
            if(tipo.type == "password"){
                tipo.type ="text";

            }
            else{
                tipo.type = "password";
            }
        }
    </script>
    <!-- FIM DO SCRIPT PARA MOSTRA SENHA -->

        <form action="logincliente.php" method="POST">
            <h1>LOGIN CLIENTE</h1>
            <input type="text" name="cpf" id="cpf" placeholder="Cpf">
            <p></p>
            <input type="password" id="senha" name="password" placeholder="Senha">
            <!-- abaixo está a função onclick chamando o script de javascript Il VVVVVVVVV -->
            <!-- <img id="olinho" onclick="mostrarsenha()" src="assets/eye.svg"> -->
            <p></p>
            <input type="submit" name="login" value="LOGIN">

            <h2>Cadastra-se</h2>
            <a href="../cadastracliente.php"><input type="button" id="cadastracliente" value="CADASTRAR"></a>
        </form>

    </div>
    
</body>
</html>