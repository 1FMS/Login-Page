<?php

if(count($_POST)>0){
    include("bd.php");
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql_code_verify_email = "SELECT email FROM usuario WHERE email='$email' ";
    $sql_exec_verify = $mysqli-> query($sql_code_verify_email);
    
    $verify_email = $sql_exec_verify->fetch_assoc();

    if($verify_email == []){
        $sql_code = "INSERT INTO usuario(nome, email, senha) VALUES('$nome','$email', '$senha')";
        $mysqli -> query($sql_code);
        if(isset($_POST['enviado'])){
        header('Location:login.php');

}
    }else{
        $span_email = "Email cadastrado já existe";
    }
    


    
}



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Formulario</title>
</head>
<body>

    <div class="left-side">
        <div class="head">
             <header class="title">
                <h1>Cadastre-se</h1>
                <hr>
            </header>
        </div>
        <div class="login-area">
            <div class="forms-area">
                <form action="" method="post" class="box">
                    <div class="box-formulario">
                        <p>Nome</p>
                        <input placeholder="Digite seu nome" type="text" name="nome" id="" class="caixa-forms">
                    </div>

                    <div class="box-formulario" id="email">
                        <p>Email</p>
                        <input placeholder="Digite seu email" type="email" name="email"  class="caixa-forms">
                        <?php
                            echo $span_email;
                        ?>
                    </div>
                        
                    <div class="box-formulario" id="senha">
                        <p>Senha</p>
                        <input placeholder="****" type="password" name="senha" class="caixa-forms">
                    </div>
                        
                    <button name="enviado" type="submit"><img src="prosseguir.svg" alt="" srcset=""></button>

                    
                </form>
                
            </div>
        </div>
    </div>
       
    <div class="right-side">
        <img src="img.svg" id="image">
    </div>

    
    
</body>
</html>