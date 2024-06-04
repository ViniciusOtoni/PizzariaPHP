<?php 
    session_start(); //inicia a sessão
    
    
    if(isset($_SESSION['carrinho']) == false)
    header('Location:/projeto/pizza/src/pages/carrinhoSemProduto/index.php');
    

    if(count($_SESSION['carrinho']) == null || count($_SESSION['carrinho']) < 1) {
       echo  '<script>location.reload();</script>';
        header('Location:/projeto/pizza/src/pages/carrinhoSemProduto/index.php');
    }

    

    if(isset($_POST['excluir'])) {
    //função responsável por remover o produto ao carrinho
    

    $produto_id_selecionado = $_POST['produto_id'];
   
    
    //Repetição na sessão para encontrar todos os itens
    foreach ($_SESSION['carrinho'] as $indice => $item) {
        if ($item->id_produto == $produto_id_selecionado) {
            // Remove o item da sessão usando o índice
            unset($_SESSION['carrinho'][$indice]);
            break; // Termina o loop após encontrar e remover o item
        }
    }

    $_SESSION['carrinho'] = array_values($_SESSION['carrinho']);
    } 
?>

<?php 
    if(isset($_POST['concluir'])) {
        include "../../bd/banco.php";
        
        $idCliente = $_SESSION['usuario']['CPF'];
        $dataAtual = date("Y-m-d");
        $valorTotal = 0;

        for($i =0; $i < count($_SESSION['carrinho']); $i++) {
            $item = $_SESSION['carrinho'][$i];
            $quantidadeProd = $item->prod_quantidade;
            $valorTotal +=  $item->prod_preco_unit * $quantidadeProd;
        }


        $res = mysqli_query($_con, 'INSERT INTO tb_pedido (tb_cliente_CPF, ped_valor_total, ped_data_cadastro) values (\''.$idCliente.'\' , \''.$valorTotal.'\' , \''.$dataAtual.'\')');

        $idPedido = mysqli_insert_id($_con);
        
     
 
        for($i = 0; $i < count($_SESSION['carrinho']); $i++) {

            $item = $_SESSION['carrinho'][$i];
            $quantidadeProd = $item->prod_quantidade;
            $precoTotalProd = $item->prod_preco_unit * $quantidadeProd;

            $res = mysqli_query($_con, 'INSERT INTO itens_pedido (tb_pedido_num_pedido, tb_produto_id_produto, itens_pedido_quantidade_prod, itens_pedido_valorTotal_prod) values (\''.$idPedido.'\' , \''.$item->id_produto.'\' , \''.$quantidadeProd.'\' , \''.$precoTotalProd.'\')');
        }

        echo '<script>alert("COMPRA CONCLUIDA!");</script>';
        unset( $_SESSION['carrinho'] );
        header('Location:/projeto/pizza/src/pages/home/index.php');
         
    

    }
?> 




<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carrinho - Jadde's Food</title>
<link rel="stylesheet" href="index.css">
<link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <nav class="navigation">
            <div> 
                <a href="#" class="brand">Jadde's Food</a>
                <a href="/projeto/pizza/src/pages/home/index.php" class="navigation-item">Cardápio</a>
            </div>
            <a href="/projeto/pizza/src/pages/produto/index.php" class="navigation-item">Voltar</a>
        </nav>
    </header>
    <main class="main-content">
        <h1>Carrinho:</h1>
        <?php


        for($i = 0; $i < count($_SESSION['carrinho']); $i++) {
        
        $item = $_SESSION['carrinho'][$i]; // Acessa o item atual no carrinho
        $rotaImg = $item->prod_image;

         echo '<div class="cart-item">
             <img src="'.$rotaImg.' " alt="'.$item->prod_descricao.'" class="item-image">
            <div class="item-details">
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post"> 
                    <span>QTD: </span>
                    <span> '.$item->prod_quantidade.' </span> 
                <div class="agp-informacoes"> 
                    <input type="hidden" name="produto_id" value="'.$item->id_produto.'">
                    <input  type="submit" value="Remover" name="excluir" class="remove-item">
                    <span class="price">Preço: '.$item->prod_preco_unit * $item->prod_quantidade.' </span>
                </div>
                </form>
            </div>
        </div>';
        }
        ?>
        
        <div class="total">
            <?php 
            $valorTotal = 0;
            for($i =0; $i < count($_SESSION['carrinho']); $i++) {
                $item = $_SESSION['carrinho'][$i];
                $valorTotal +=  $item->prod_preco_unit * $item->prod_quantidade;
            }
                echo '
                    <span>Total Geral: R$'.$valorTotal.' </span>
                ';
            ?>
        </div>
        <?php 
        echo '
            <form action="'.$_SERVER['REQUEST_URI'].'"  method="post" class="actions">
                <a href="/projeto/pizza/src/pages/home/index.php" class="continue-shopping">Continuar comprando</a>
                <input type="submit" name="concluir" value="Concluir Compra" class="checkout">
            </form>
        ';
        ?> 
    </main>
</body>
</html>
