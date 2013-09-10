<?php
error_reporting(0);
include_once 'autoload.php';

$Controlador = new Controlador();

echo $Controlador->executa($_REQUEST['tarefa'], $_REQUEST['parametros_da_tarefa']);
