<?php
include_once '../autoload.php';

error_reporting(0);

$ControladorGaleria = new GaleriaControlador();

try {
    echo $ControladorGaleria->executa($_REQUEST['tarefa'], $_REQUEST['parametros_da_tarefa']);    
} catch (Exception $exc) {
    echo "{falha: '" . $exc->getMessage() . "'}";
}
