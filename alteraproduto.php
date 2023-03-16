<?php
#Conexão do Banco de Dados
include("conectadb.php");

#Coleta de Variáveis dos campos de texto HTML
if($_SERVER['REQUEST_METHOD']=='POST'){
    $nome = $_POST['nome'];
    $id = $_POST['id'];
    $descricao	= $_POST['descricao'];
    $quantidade	= $_POST['quantidade'];
    $preco = $_POST['preco'];
    $ativo = $_POST['ativo'];

    # CRITOGRAFRA A FOTO PARA O BANCO DE DADOS
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK){
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        $imagem_base64 = base64_encode($imagem);
    }

    #Instrução SQL para atualização de usuario e senha
    $sql = "UPDATE produtos SET nome='$nome', pro_descricao = '$descricao', pro_quantidade='$quantidade',pro_preco = '$preco', pro_ativo= '$ativo', imagem1 = '$imagem_base64' WHERE pro_id ='$id'";
    mysqli_query($link, $sql);
    header("Location: listaproduto.php");
    echo"<script>window.alert('Produto alterado com Sucesso!');</script>";
    exit();

}


#Coletando ID via Link(URL) exemplo alterausuario.php?id=2 TESTE DE ALTERÇÃO VIA GITHUB
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$resultado = mysqli_query($link, $sql);

while($tbl = mysqli_fetch_array($resultado)){
    $nome = $tbl[4];
    $descricao = $tbl[1];
    $quantidade = [2];
    $preco = [3];
    $ativo = [5]; 
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newestilo.css">

    <title>ALTERAR PRODUTO</title>
</head>
<body>
<a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>

    <div>
        <form action="alteraproduto.php" method="post" enctype="multipart/form-data">            
            <input type="hidden" name="id" value="<?=$id?>"> <!-- coleta id ao carrega a página de forma oculta-->
            <label>NOME</label>
            <input type="text" name="nome" value="<?=$nome?>" required> <!-- Coleta o nome do produto e preenche a txtbox-->
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricao" value="<?=$descricao?>" required> <!-- Coleta a descrição do produto e preenche a txtbox-->   
            <label>QUANTIDADE</label>
            <input type="number" name="quantidade" value="<?=$quantidade?>" required> <!-- Coleta o nome do produto e preenche a txtbox-->
            <label>PREÇO</label>
            <input type="number" name="preco" value="<?=$preco?>" required> <!-- Coleta o preço do produto e preenche a txtbox-->
            <br></br>        
            <label>IMAGEM</label>
            <input type="file" name="imagem" id="imagem" onchange="foto1()">
            
            <label>Status: <?=$check = ($ativo == 's')? "ATIVO": "DESATIVO"?></label>
            <br>
            <input type="radio" name="ativo" value="s" <?=$ativo == "s"? "checked":""?>>ATIVO<br>
            <input type="radio" name="ativo" value="n"<?=$ativo == "n"? "checked":""?>>INATIVO
            <input type="submit" value="SALVAR">

        </form>
    </div>
    
</body>
</html>
