<?php

/**
 * @var mysqli $con_bd
 */

$con_bd = false;

try {
    $con_bd = mysqli_connect(
        "localhost",
        "root",
        "",
        "tedsi",
        3307
    );
} catch (Exception $e) {
    echo "Erro conectando ao banco de dados!"
        . " <br>Código do erro: ".$e->getCode();
}

?>