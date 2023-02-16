<?php
#Conexão do Banco de Dados
include("conectadb.php");

#Coleta de Variáveis dos campos de texto HTML
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome = $_POST["nome"];
    $pro_id = $_POST['id'];
    $pro_descricao	= $_POST["descricao"];
    $pro_quantidade	= $_POST["quantidade"];
    $pro_preco = $_POST['preco'];
    $ativo = $_POST['ativo'];
    
    #Instrução SQL para atualização de usuario e senha
    $sql = "UPDATE usuarios SET nome='$nome', pro_decricao = '$decricao', pro_quantidade='$quantidade',pro_preco = '$preco', ativo = '$ativo' WHERE pro_id ='$id'";
    mysqli_query($link, $sql);
    header("Location: listaproduto.php");
    echo"<script>window.alert('Usuario alterado com Sucesso!');</script>";
    exit();

}


#Coletando ID via Link(URL) exemplo alterausuario.php?id=2 TESTE DE ALTERÇÃO VIA GITHUB
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id = $id";
$resultado = mysqli_query($link, $sql);
while($tbl = mysqli_fetch_array($resultado)){
    $nome = $tbl[4];
    $pro_descricao = $tbl[1];
    $pro_quantidade = [2];
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>ALTERAR USUARIO</title>
</head>
<body>
    <div>
        <form action="alteraproduto.php" method="post">
            <label>ID</label>
            <input type="text" name="id" value="<?=$id?>" > <!-- coleta id ao carrega a página de forma oculta-->
            <label>NOME</label>
            <input type="text" name="nome" value="<?=$nome?>" required> <!-- Coleta o nome do usuario e preenche a txtbox-->
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricao" value="<?=$descricao?>" required> <!-- Coleta a senha do usuario e preenche a txtbox-->   
            <label>QUANTIDADE</label>
            <input type="text" name="quantidade" value="<?=$quantidade?>" required> <!-- Coleta o nome do usuario e preenche a txtbox-->
            <label>PREÇO</label>
            <input type="text" name="preco" value="<?=$preco?>" required> <!-- Coleta a senha do usuario e preenche a txtbox-->
            <br></br>  
            <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>
