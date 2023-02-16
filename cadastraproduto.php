<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $pro_descricao	= $_POST["descricao"];
    $pro_quantidade	= $_POST["quantidade"];
    $pro_preco = $_POST['preco'];
    Include("conectadb.php");

    #VERIFICA USUARIO EXISTENTE
    $sql ="SELECT COUNT(pro_id) from produtos WHERE nome = '$nome'";
    $resultado = mysqli_query($link,$sql);
    while($tbl = mysqli_fetch_array($resultado)){
        $cont = $tbl[0];
    }
    #Verificação visual se usuario existe ou não.
    if($cont==1){
        echo"<script>window.alert('PRODUTO JÁ CADASTRADO!');</script>";
    }
    else{
        $sql = "INSERT INTO produtos(pro_descricao, pro_quantidade, pro_preco, nome) VALUES('$pro_descricao', '$pro_quantidade','$pro_preco', '$nome')";
        mysqli_query($link,$sql);
        header("Location: listaproduto.php");
    }
}

?>
<!-- pro_id	,pro_descricao,	pro_quantidade,	pro_preco	 -->
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>CADASTRO DE PRODUTOS</title>

</head>
<body>
    <a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    <div>

        <form action="cadastraproduto.php" method="POST">
            <h1>CADASTRO DE PRODUTOS</h1>
            <input type="text" name="nome" id="nome" placeholder="NOME DO PRODUTO" required>
            <p></p>
            <input type="text" name="descricao" id="descricao" placeholder="DESCRIÇÃO DO PRODUTO" required>
            <p></p>
            <input type="text" id="quantidade" name="quantidade" placeholder="QUANTIDADE DE PRODUTO" required>
            <p></p>
            <input type="text" id="preco" name="preco" placeholder="PREÇO DO PRODUTO" required>
            <p></p>
            <input type="submit" name="cadastrar" id="cadastrar" value="CADASTRAR">
        </form>

    </div>
</body>
</html>