<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = $_POST["nome"];
        $pro_descricao	= $_POST["descricao"];
        $pro_quantidade	= $_POST["quantidade"];
        $pro_preco = $_POST['preco'];
        
        # CRITOGRAFRA A FOTO PARA O BANCO DE DADOS
        if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
            $imagem_temp = $_FILES['imagem']['tmp_name'];
            $imagem = file_get_contents($imagem_temp);
            $imagem_base64 = base64_encode($imagem);
        }

        # Faz a conecção com o conectadb.php
        Include("conectadb.php");

        #VERIFICA projeto EXISTENTE
        $sql ="SELECT COUNT(pro_id) from produtos WHERE nome = '$nome'";
        $resultado = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($resultado)){
            $cont = $tbl[0];
        }
        #Verificação visual se o produto existe ou não.
        if($cont==1){
            echo"<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
        }
        else{
            $sql = "INSERT INTO produtos(pro_descricao, pro_quantidade, pro_preco, nome, pro_ativo, imagem1) VALUES('$pro_descricao', '$pro_quantidade','$pro_preco', '$nome','s', '$imagem_base64')";
            mysqli_query($link,$sql);
            header("Location: listaproduto.php");
        }
    }

?>
<!-- pro_id	,pro_descricao,	pro_quantidade,	pro_preco	 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newestilo.css">
    <title>CADASTRO DE PRODUTOS</title>

</head>
<body>
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div>

        
        <form action="cadastraproduto.php" method="POST" enctype="multipart/form-data">
            <h1>CADASTRO DE PRODUTOS</h1>
            <input type="text" name="nome" id="nome" placeholder="NOME DO PRODUTO" required>
            <br><br>
            <input type="text" name="descricao" id="descricao" placeholder="DESCRIÇÃO DO PRODUTO" required>
            <br><br>
            <input type="number" id="quantidade" name="quantidade" placeholder="QUANTIDADE DE PRODUTO" required>
            <br><br>
            <input type="number" id="preco" name="preco" placeholder="PREÇO DO PRODUTO" required>
            <br><br><br>

            <label>IMAGEM</label>
            <input type="file" name="imagem" id="imagem" onchange="foto1()">
            
            <br>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">
        </form>

        <script>
            function foto1(){
                document.getElementById("foto1a").src = "img/"(document.getElementById("img1").value).slice(12);
            }
        </script>

    </div>
</body>
</html>