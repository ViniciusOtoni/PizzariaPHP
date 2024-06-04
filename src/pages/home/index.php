<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cardápio de Pizzas</title>
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <header class="header-main">
        <nav class="navigation">
            <div> 
                <a href="#" class="brand">Jadde's Food</a>
                <a href="/projeto/pizza/src/pages/pedidos/index.php" class="navigation-item">Pedidos</a>
            </div>
            <a href="/projeto/pizza/src/pages/carrinho/index.php" class="navigation-item"> Carrinho </a>
        </nav>
    </header>
    <header class="header">
        <h1>Pizzas</h1>
    </header>
    <nav class="navbar">
        <button class="nav-button active">Pizzas</button>
        <a href="/projeto/pizza/src/pages/homeDrink/index.php" class="nav-button">Bebidas</a>
    </nav>
    <h2>Cardápio:</h2>
    <section class="menu">
    <?php
     
        include "../../bd/banco.php";

        $res = mysqli_query($_con, "SELECT * FROM tb_pizza");
    

        while($row = $res ->fetch_object()) {
        echo '
            <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="menu-item">
                <img src="'.$row->prod_image.'" alt="'.$row->prod_descricao .'">
                <p>'.$row->prod_descricao .'</p>
                <input type="hidden" name="produto_id" value="'.$row->tb_produto_id_produto.'">
                <input type="submit" name="ver" value="Verificar" class="verificar"> 
            </form>';

            if(isset($_POST['ver'])) {

                $produto_id_selecionado = $_POST['produto_id'];
                $consulta = mysqli_query($_con, "SELECT * FROM tb_pizza WHERE tb_produto_id_produto = $produto_id_selecionado");
                $produto_selecionado = mysqli_fetch_object($consulta);

                $_SESSION['produto'] = array(
                    'id_produto' => $produto_selecionado->tb_produto_id_produto,
                    'prod_descricao' => $produto_selecionado->prod_descricao,
                    'prod_image' => $produto_selecionado->prod_image,
                    'prod_preco_unit' => $produto_selecionado->prod_preco
                ); 
                header('Location:/projeto/pizza/src/pages/produto/index.php');
                exit; 
           } 

        
        }
        ?>

    </section>
    <footer class="main-footer">
        <div class="footer-content">
            <h3>Jadde's Food</h3>
            <p>Nos siga em nossas redes sociais, e fique atento para novas ofertas</p>
   
            <div class="social-media-icons">
                <a href="#"> <img src="/projeto/pizza/public/images/image 44.svg" /> </a>
                <a href="#"> <img src="/projeto/pizza/public/images/image 45.svg" />  </a>
                <a href="#"><img src="/projeto/pizza/public/images/image 46.svg" /> </a>
            </div>
        </div>
        <div class="map">
            <img src="/projeto/pizza/public/images/Rectangle 397.png" alt="Mapa de localização">
        </div>
    </footer>
</body>
</html>
