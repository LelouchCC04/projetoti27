<?php
#Conexão do Banco de Dados
include("conectadb.php");

#Coleta de Variáveis dos campos de texto HTML
if($_SERVER['REQUEST_METHOD']=='POST'){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $ativo = $_POST['ativo'];
    
    #Instrução SQL para atualização de usuario e senha
    $sql = "UPDATE usuarios SET usu_senha = '$senha', usu_nome='$nome', usu_ativo = '$ativo' WHERE usu_id ='$id'";
    mysqli_query($link, $sql);
    header("Location: listausuario.php");
    echo"<script>window.alert('Usuario alterado com Sucesso!');</script>";
    exit();

}


#Coletando ID via Link(URL) exemplo alterausuario.php?id=2 TESTE DE ALTERÇÃO VIA GITHUB
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id = $id";
$resultado = mysqli_query($link, $sql);
while($tbl = mysqli_fetch_array($resultado)){
    $nome = $tbl[1];
    $senha = $tbl[2];
    $ativo = $tbl[3];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>ALTERAR USUARIO</title>
</head>
<body>
<a href="homesistema.html"><input type="button" id="menuhome" value="HOME SISTEMA"></a>
    
    <div>
        <form action="alterausuario.php" method="post">
        <input type="hidden" name="id" value="<?=$id?>" > <!-- coleta id ao carrega a página de forma oculta-->
        <label>NOME</label>
        <input type="text" name="nome" value="<?=$nome?>" required> <!-- Coleta o nome do usuario e preenche a txtbox-->
        <label>SENHA</label>
        <input type="password" name="senha" value="<?=$senha?>" required> <!-- Coleta a senha do usuario e preenche a txtbox-->
        <br></br>
        <label>Status: <?=$check = ($ativo == 's')?"ATIVO":"INATIVO";?></label>
        <br></br>
        <input type="radio" name="ativo" value="s" <?=$ativo == "s"? "checked":""?>>ATIVO<br>
        <input type="radio" name="ativo" value="n"<?=$ativo == "n"? "checked":""?>>INATIVO

        <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>
