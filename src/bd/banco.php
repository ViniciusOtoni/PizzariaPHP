<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "bd_teste";
$_con = mysqli_connect($servidor, $usuario, $senha, $banco);


if($_con===false) {
    echo "DEU RUIM";
    exit;
}

	
?>