<?php
    
    if (isset($_POST['email'])){
        include("bd.php");
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM usuario where email='$email'";
        $sql_exec = $mysqli -> query($sql_code);
        $usuario = $sql_exec->fetch_assoc();

        $usuario_senha = $usuario['senha'];
        $usuario_id = $usuario['id_user'];
        
        
        

        if (password_verify($senha, $usuario_senha)) {
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['usuario'] = $usuario_id;
            header('Location:main.php');
            
        } else {
            echo "Senha incorreta.";
        }

        

       
    }

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <p>email</p><input type="email" name="email" id="">
        <p>senha</p><input type="password" name="senha" id="">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>