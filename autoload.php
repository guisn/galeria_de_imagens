<?php

foreach (require_once('config.php') as $nome_da_configuracao => $valor) {
    define($nome_da_configuracao, $valor);
}

function __autoload($class_name) {
    require_once 'classes/' . $class_name . '.php';
}
?>
