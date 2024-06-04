<?php 
    session_start(); //inicia a sessão
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detalhes do Pedido</title>
<link rel="stylesheet" href="index.css">
<link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
<?php 
    echo '
    <div class="order-container">
        <a href="/projeto/pizza/src/pages/home/index.php" class="voltar-btn">Voltar</a>
        <div class="order-header">
            <p>Pedido Nº '.$_SESSION['pedido']['num_pedido'].'</p>
        </div>
        <div class="order-body">
            <div class="product-info">
                <img src="/projeto/pizza/public/images/image 20.svg" alt="Caixa" class="box-icon">
                <div class="details">
                    <p>Destinatário: '.$_SESSION['usuario']['cli_nome'].' <p>';

                    
                        include "../../bd/banco.php";
                
                        $res = mysqli_query($_con, 'SELECT * FROM itens_pedido where tb_pedido_num_pedido = '.$_SESSION['pedido']['num_pedido'].'');
                        $quantidadeProdutos  = mysqli_num_rows($res);
                        $valorTotalProdutos;
                        for($i = 0; $i < $quantidadeProdutos; $i++) {

                        }
                        echo '<p>Quantidade Produtos: '.$quantidadeProdutos.' </p>';
                   
                  echo '  
                    </div>
                        <div class="total">
                            <p>Total do Consumo:  '.$_SESSION['pedido']['ped_valor_total'].'  </p>
                        </div>
                    </div>';
                ?> 
                    
                <?php

                    echo '
                    
               
            <div class="payment-info">
                <h3>Informações de Pagamento</h3>
                <div class="payment-details">
                    <p>Método de pagamento: Dinheiro</p>
                    <p>Nome: '.$_SESSION['usuario']['cli_nome'].'</p>
                    <p>Endereço: '.$_SESSION['usuario']['cli_endereco'].' </p>
                </div>
                <div class="total-general">
                    <p>Total Geral: R$ '.$_SESSION['pedido']['ped_valor_total'].'</p>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer-content">
                <h3>Jadde `s Food</h3>
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
    </div>';
    ?>
</body>
</html>
