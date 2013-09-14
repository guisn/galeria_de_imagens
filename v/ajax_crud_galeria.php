<?php
include_once '../autoload.php';

error_reporting(0);

$Controlador = new GaleriaControlador();

echo $Controlador->executa($_REQUEST['tarefa'], $_REQUEST['parametros_da_tarefa']);
