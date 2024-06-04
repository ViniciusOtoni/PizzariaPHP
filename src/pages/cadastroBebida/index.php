<?php 

    session_start();
   

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastrar Bebida</title>
<link rel="stylesheet" href="estilo.css">
<link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
<?php 

    include "../../bd/banco.php";

   


    if(isset($_POST['enviar'])) {

        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $rota_imagem = $_POST['imagem'];

        $resProd =  mysqli_query($_con, 'INSERT INTO tb_produto () values () ');
        $idProduto = mysqli_insert_id($_con);

        $res = mysqli_query($_con, 'INSERT INTO tb_bebida (tb_produto_id_produto, prod_descricao, prod_preco, prod_image) values (\''.$idProduto.'\' , \''.$descricao.'\' , \''.$preco.'\' , \''.$rota_imagem.'\')');
        

    header('Location:/projeto/pizza/src/pages/home/index.php');
    exit; 
    }

   

    echo'   
    <div class="registro-container">
        <a href="/projeto/pizza/src/pages/home/index.php" class="voltar-btn">Voltar</a>
        <h1>Cadastrar Bebida: </h1>
        <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="registro-form">
            <input type="text" id="nome" placeholder="Descrição"  name="descricao">
            <input type="text" id="cpf" placeholder="Preço" name="preco">
            <input type="text" id="email" placeholder="Rota Imagem" name="imagem">
            <input type="submit" name="enviar" class="criar-btn" value="Cadastrar">
        </form>
    </div>'
    ?> 
</body>
</html>
