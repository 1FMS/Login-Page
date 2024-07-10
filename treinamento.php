<?php
    include("bd.php");
    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        die("Você não está logado.<a href='login.php'>Click aqui para logar novamente</a>");
    }
    $id_treinamento = $_GET['id_treinamento'];

    $sql_code_dados_treinamento = "SELECT * FROM treinamento WHERE id_treinamento='$id_treinamento'";
    $sql_exec_dados_treinamento = $mysqli->query($sql_code_dados_treinamento);
    $dados_treinamento = $sql_exec_dados_treinamento->fetch_assoc();
    $nome_treinamento= $dados_treinamento['nome_treinamento'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    echo $nome_treinamento;

    ?>
</body>
</html>