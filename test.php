<form action="listaproduto.php" method="post" class="ativos">
            <input type="radio" name="ativo" value="s" required onclick="submit()" <?=$ativo=='s'?"checked":""?>>DISPONIVEL <br>
            <input type="radio" name="ativo" value="n" required onclick="submit()" <?=$ativo=='n'?"checked":""?>>INDISPONIVEL
</form>

$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$resultado = mysqli_query($link, $sql);
$ativo = 's';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $ativo = $_POST['ativo'];
    
    if ($ativo == 's'){
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's';";
        $resultado = mysqli_query($link, $sql);

    }
    else{
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n';";
        $resultado = mysqli_query($link, $sql);
    }
}


<?php
    include("conectadb.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $datanasc = $_POST["datanasc"];
        $telefone = $_POST["telefone"];
        $logradouro = $_POST["logradouro"];
        $numero = $_POST["numero"];
        $cidade = $_POST["cidade"];
        $ativo = $_POST["ativo"];


        $sql = "UPDATE clientes SET cli_nome = '$nome', cli_cpf = '$cpf', cli_datanasc = STR_TO_DATE('$datanasc','%Y-%m-%d'), cli_telefone = '$telefone', cli_logradouro = '$logradouro', cli_numero = '$numero', cli_cidade = '$cidade', cli_ativo = '$ativo' WHERE cli_id = $id";
        mysqli_query($link, $sql);

        header("Location: listacliente.php");
        echo"<script>window.alert('CLIENTE ALTERADO!');</script>";
        
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM clientes WHERE cli_id = $id";
    
    $resultado = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($resultado)){
        $nome = $tbl[2];
        $cpf = $tbl[1];
        $datanasc = $tbl[3];
        $telefone = $tbl[4];
        $logradouro = $tbl[5];
        $numero = $tbl[6];
        $cidade = $tbl[7];
        $ativo = $tbl[8];

    }

?>


<!DOCTYPE html>
<html lang="en">
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
        <form action="alteracliente.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <label>NOME</label>
            <input type="text" name="nome", value="<?=$nome?>" required>
            <br></br>
            <label>CPF</label>
            <input type="number" name="cpf", value="<?=$cpf?>" required>
            <br></br>
            <label>DATA DE NASCIMENTO</label>
            <input type="date" name="datanasc", value="<?=date($datanasc)?>" required>
            <br></br>
            <label>TELEFONE</label>
            <input type="number" name="telefone", value="<?=$telefone?>" required>
            <br></br>
            <label>LOGRADOURO</label>
            <input type="text" name="logradouro", value="<?=$logradouro?>" required>
            <br></br>
            <label>NUMERO</label>
            <input type="text" name="numero", value="<?=$numero?>" required>
            <br></br>
            <label>CIDADE</label>
            <input type="text" name="cidade", value="<?=$cidade?>" required>
            <br></br>
            
            <label>STATUS: <?=$check = ($ativo == 's')?"ATIVO":"INATIVO"?></label><br>

            <input type="radio" name="ativo" value="s" <?=$ativo == "s"?"checked":""?>>ATIVO<br>
            <input type="radio" name="ativo" value="n" <?=$ativo == "n"?"checked":""?>>INATIVO

            <input type="submit" value="SALVAR">

        </form>
    </div>
</body>
</html>