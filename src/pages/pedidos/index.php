<?php 
    session_start(); //inicia a sessão
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seus Pedidos</title>
<link rel="stylesheet" href="styles.css">
<link href="https://fonts.googleapis.com/css?family=Alatsi&display=swap" rel="stylesheet">
</head>
<body>
    <main class="main-content">
        <a href="/projeto/pizza/src/pages/home/index.php" class="voltar-btn">Voltar</a>
        
        <h1>Seus Pedidos</h1>
        <section class="pedidos">
        
        <?php 
    
    


        include "../../bd/banco.php";

        $idCliente = $_SESSION['usuario']['CPF'];

        $res = mysqli_query($_con, "SELECT * FROM tb_pedido where tb_cliente_cpf = $idCliente");

        if(mysqli_num_rows($res) < 1)
            header('Location:/projeto/pizza/src/pages/pedidoSemProduto/index.php');
    
        echo ' <h2> '.mysqli_num_rows($res).' Pedidos</h2>';

            while($row = $res ->fetch_object()) { 
                echo '
                <form action="'.$_SERVER['REQUEST_URI'].'"  method="post"  class="pedido">
                    <div class="pedido-info">
                        <img src="/projeto/pizza/public/images/image 18.svg" />
                        <p>Pedido realizado</p>
                        <p>'.$row->ped_data_cadastro.'</p>
                    </div>
                    <div class="pedido-actions">
                        <input type="hidden" name="pedido_id" value="'.$row->num_pedido.'">
                        <div class="numero-pedido"> Pedido Nº '.$row->num_pedido.'</div>
                        <input type="submit" name="ver" value="Ver Pedido">
                    </div>
              </form>
              ';

              if(isset($_POST['ver'])) {

                $pedido_id_selecionado = $_POST['pedido_id'];
                $consulta = mysqli_query($_con, "SELECT * FROM tb_pedido WHERE num_pedido = $pedido_id_selecionado");
                $pedido_selecionado = mysqli_fetch_object($consulta);

                $_SESSION['pedido'] = array(
                    'num_pedido' => $pedido_selecionado->num_pedido,
                    'ped_valor_total' => $pedido_selecionado->ped_valor_total,
                    'ped_data_cadastro' => $pedido_selecionado->ped_data_cadastro,
                );
                header('Location:/projeto/pizza/src/pages/pedidoUnitario/index.php');
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
    </main>
</body>
</html>
