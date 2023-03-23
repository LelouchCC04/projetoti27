<?php

    include("../conectadb.php");

    #BUSCA A VARIAVEL DE SESSÃO DO USUARIO
    session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $idproduto = $_POST['idproduto'];
        $nomeproduto = $_POST['nomeproduto'];
        $descricaoproduto = $_POST['descricaoproduto'];
        $quantidadeproduto = $_POST['quantidadeproduto'];
        $totalparcial = $_POST['totalparcial'];
        $totalparcial = [$preco * $quantidade];
        
        #VARIAVEL CRIADA PARA INDENTIFICAÇÃO DO CARRINHO
        $numerocarrinho = MD5(date('H').date('i').date('s').date('Y').date('m').date('d'));
        echo($numerocarrinho);
    }
    
?>