<?php 

    session_start();
   

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Criar Conta</title>
<link rel="stylesheet" href="estilo.css">
<link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
<?php 

    include "../../bd/banco.php";

   


    if(isset($_POST['enviar'])) {

        $valorInput = $_POST['cpf'];
        $nome = $_POST['nome'];
        $email = $_con->real_escape_string($_POST['email']);
        $senha = $_con->real_escape_string($_POST['senha']);
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];

        $res = mysqli_query($_con, 'INSERT INTO tb_cliente (CPF, cli_nome, cli_email, cli_senha, cli_endereco, cli_telefone) values (\''.$valorInput.'\' , \''.$nome.'\' , \''.$email.'\' , \''.$senha.'\' ,  \''.$endereco.'\' , \''.$telefone.'\')');
        $CPF = mysqli_insert_id($_con);
        

        $query = "SELECT * FROM tb_cliente WHERE CPF= $valorInput";
         
        $resLog =  mysqli_query($_con, $query);

        if ($resLog) {
            
            $usuario_atual = mysqli_fetch_object($resLog);
         
            $_SESSION['usuario'] = array (
                'CPF' => $usuario_atual->CPF,
                'cli_nome' => $usuario_atual->cli_nome,
                'cli_email' => $usuario_atual->cli_email,
                'cli_senha' => $usuario_atual->cli_senha,
                'cli_endereco' => $usuario_atual->cli_endereco,
                'cli_telefone' => $usuario_atual->cli_telefone
            );
            
            header('Location: /projeto/pizza/src/pages/home/index.php');
           
        } 

        exit; 
    }

   

    echo'   
    <div class="registro-container">
        <a href="/projeto/pizza/src/pages/login/index.php" class="voltar-btn">Voltar</a>
        <h1>Digite seus dados: </h1>
        <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="registro-form">
            <input type="text" id="nome" placeholder="Nome"  name="nome">
            <input type="text" id="cpf" placeholder="CPF" name="cpf">
            <input type="text" id="email" placeholder="E-mail" name="email">
            <input type="password" id="senha" placeholder="Senha" name="senha">
            <input type="text" id="endereco" placeholder="Endereço" name="endereco">
            <input type="tel" id="telefone" placeholder="Telefone" name="telefone">
            <input type="submit" name="enviar" class="criar-btn" value="Criar Conta">
        </form>
    </div>'
    ?> 
</body>
</html>
