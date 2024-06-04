<?php 
    session_start();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
    <link rel="stylesheet"  href="index.css"  />
    <title>LOGIN</title>
</head>
<body>
    <?php 
        

        include "../../bd/banco.php";
        

        if(isset($_POST['logar'])) {

            $email = $_con->real_escape_string($_POST['email']);
            $senha =  $_con->real_escape_string($_POST['senha']);

            $query = "SELECT * FROM tb_cliente WHERE cli_email = '$email' AND cli_senha = '$senha'";
           
            $res = mysqli_query($_con, $query); 
            
            if ($res) {
                    $usuario_atual = mysqli_fetch_object($res);
                if ($usuario_atual) {
                    
                    $_SESSION['usuario'] = array (
                        'CPF' => $usuario_atual->CPF,
                        'cli_nome' => $usuario_atual->cli_nome,
                        'cli_email' => $usuario_atual->cli_email,
                        'cli_senha' => $usuario_atual->cli_senha,
                        'cli_endereco' => $usuario_atual->cli_endereco,
                        'cli_telefone' => $usuario_atual->cli_telefone
                    );
                    
                        header('Location: /projeto/pizza/src/pages/home/index.php');
                        exit;
                } else {
                    echo "<script> alert('Usuário não encontrado') </script> ";
                }
            } else {
                echo  '<script> alert('.$_con->error.') </script> ';
            }

        } 
        

        

        echo '
        <div class="main"> 
            <div class="esquerda">
                <div class="img">  <img src="image 40.svg" alt="" /> </div>
            </div>
            <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="direita">
                <div class="agp-titulo"> 
                    <div class="nome"> Jadde´s </div> 
                    <div class="comida"> Food </div>
                </div>
                <div class="agrupamento">
                    <div class="titulo-agp">E-mail: </div>
                    <input class="input" type="text" value=" " name="email"/>
                </div>
                <div class="agrupamento">
                    <div class="titulo-agp">Senha: </div>
                    <input class="input" type="password" value="" name="senha" />
                </div>
                <input class="entrar" type="submit" value="Entrar" name="logar">
                <div class="conta"> Ainda não tem conta? <a href="/projeto/pizza/src/pages/criarConta/index.php" class="bold"> Crie agora </a> </div>
            </form>
        </div>';
    ?>
</body>
</html>