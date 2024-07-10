<?php
    
    include("bd.php");
    if(!isset($_SESSION))
        session_start();
    
    if(!isset($_SESSION['usuario'])){
        die("Você não está logado.<a href='login.php'>Click aqui para logar novamente</a>");
    }
    $nome_user_sql = $_SESSION['usuario'];
    $sql_code = "SELECT nome FROM usuario where id_user='$nome_user_sql'";
    $sql_exec = $mysqli -> query($sql_code);
    $usuario = $sql_exec->fetch_assoc();
    
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo $usuario['nome']?></h1>
    <form action="" method="get">
        <button type="submit" method="get" name="criar_treinamento">Criar Treinamento</button>
        <button type="submit" method="get" name="acessar_treinamento">Acessar Treinamentos</button>
    </form>
    <?php
        if(isset($_GET['criar_treinamento'])){
            
            ?>
            <div class="main_fomrs">
                <form action="" method="post">
                    <p>Nome do treinamento</p>
                    <input type="text" name="nome_forms_treinamento" id="">
                    
                    <p>Data do treinamento</p>
                    <input type="date" name="data_forms_treinamento" id="">
                    
                    <p>Resumo do treinamento</p>
                    <input type="text" name="resumo_forms_treinamento" id="">
                   
                    <p>Status</p>
                    <input type="radio" name="status_forms_treinamento" value="Finalizada">
                    <label for="Finalizada">Finalizada</label>
                    <input type="radio" name="status_forms_treinamento" value="Bloqueado">
                    <label for="Bloqueado">Bloqueado</label>
                    <input type="radio" name="status_forms_treinamento" value="Liberada">
                    <label for="Liberada">Liberada</label>
                    
                    <button type="submit" name="bt_criar_treinamento">Criar Treinamento</button>
                </form>


            </div>
            <?php
        }
        if(isset($_POST['bt_criar_treinamento'])){
            $nome_forms = $_POST['nome_forms_treinamento'];
            $data_forms = $_POST['data_forms_treinamento'];
            $resumo_forms = $_POST['resumo_forms_treinamento'];
            $status_forms = $_POST['status_forms_treinamento'];

            $erros = []; // Array para armazenar mensagens de erro

        // Validação do nome do treinamento
        if (empty($nome_forms)) {
            $erros[] = "Preencha o campo Nome do Treinamento.";
        }

        // Validação da data do treinamento
        if (empty($data_forms)) {
            $erros[] = "Preencha o campo Data do Treinamento.";
        }

        // Validação do resumo do treinamento
        if (empty($resumo_forms)) {
            $erros[] = "Preencha o campo Resumo do Treinamento.";
        }

        // Validação do status do treinamento
        if (empty($status_forms)) {
            $erros[] = "Selecione o Status do Treinamento.";
        }

        if (count($erros) > 0) {
            echo "<ul style='color: red'>";
              foreach ($erros as $erro) {
                echo "<li>$erro</li>";
              }
            echo "</ul>";
          } else{
            $sql_code_criar_treinamento = "INSERT INTO treinamento(nome_treinamento, status_treinamento, resumo_treinamento, data_treinamento ) VALUES('$nome_forms','$status_forms','$resumo_forms','$data_forms')";
            $sql_exec_criar_treinamento = $mysqli->query($sql_code_criar_treinamento);

            if($sql_exec_criar_treinamento){
                header('Location: main.php');
            }
          }
            
        }
    ?>

    <?php
        if(isset($_GET['acessar_treinamento'])){
            $sql_code_acessar_treinamento = "SELECT * FROM treinamento";
            $sql_exec_acessar_treinamento = $mysqli->query($sql_code_acessar_treinamento);
            
        

        while($dados_treinamento = $sql_exec_acessar_treinamento->fetch_assoc()){
            $nome_treinamento = $dados_treinamento['nome_treinamento'];
            $id_treinamento = $dados_treinamento['id_treinamento'];
            
            
            
    ?>
            <form action="treinamento.php" method="get">
                <input type="hidden" name="id_treinamento" value="<?php echo $id_treinamento; ?>">
                <button type="submit"><?php echo $nome_treinamento?></button>
            </form>
    <?php
        }
        }
        
        
    ?>
</body>
</html>