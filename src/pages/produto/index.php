<?php
    session_start(); //inicia a sessão para manter as informações;
?>


<?php 
    if(isset($_POST['enviar'])) { 
    //função responsável por adicionar o produto ao carrinho  
        
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array(); //ver se já tem algo no carrinho
        }

        // ver se o produto já está no carrinho
        $produto_existente = false;

        foreach ($_SESSION['carrinho'] as $item) {
            if ($item->id_produto == $_SESSION['produto']['id_produto']) {
                // O produto já está no carrinho, incrementar a quantidade
                $item->prod_quantidade++;
                $produto_existente = true;
                break;
            }
        }

        //não tem o produto
        if (!$produto_existente) {
            $novo_produto = new stdClass();
            
            $novo_produto->id_produto = $_SESSION['produto']['id_produto'];
            $novo_produto->prod_descricao = $_SESSION['produto']['prod_descricao'];
            $novo_produto->prod_quantidade = 1;
            $novo_produto->prod_preco_unit = $_SESSION['produto']['prod_preco_unit'];
            $novo_produto->prod_image = $_SESSION['produto']['prod_image'];
            
            $_SESSION['carrinho'][] = $novo_produto;

        }

        header('Location:/projeto/pizza/src/pages/carrinho/index.php');
        exit; 
    } 
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
    <?php 



        echo
            '<div class="product-card">
            <header class="product-header">
                <h1>Produto</h1>
            </header>
            <div class="product-content">
                <div class="product-image">
                    <img src="'.$_SESSION['produto']['prod_image'].'" alt="'.$_SESSION['produto']['prod_descricao'].'">
                </div>
                <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="product-info">
                    <h2>Nome: '.$_SESSION['produto']['prod_descricao'].' </h2>
                    <p>Preço: R$: '.$_SESSION['produto']['prod_preco_unit'].' </p>
                    <input type="submit" name="enviar" class="add-product">
                
                    <a href="/projeto/pizza/src/pages/home/index.php" class="add-product" id="back"> Voltar </a>
                </div>
            </div>
            </div>';
    ?>
</body>
</html>
