<?php
// Charset oficial do sistema
header('Content-Type: text/html; charset=utf-8');

// Carrega configurações do sistema
foreach (require_once('config.php') as $nome_da_configuracao => $valor) {
    define($nome_da_configuracao, $valor);
}

// Error reporting padrão do sistema
// DEBUG
error_reporting(E_ERROR);
// PROD
//error_reporting(0);

function __autoload($class_name) {
    
    // Classes de nivel mais baixo do sistema (Ditam as regras).
    include_once 'classes/nucleo/' . $class_name . '.php';
    
    // Classes de controle de acesso a dados.
    include_once 'classes/DAO/' . $class_name . '.php';
    
    // Classes de controle de requisições.
    include_once 'classes/controladores/' . $class_name . '.php';
    include_once 'classes/negocio/' . $class_name . '.php';
    
    // Classes com componentes uteis e reaproveitaveis.
    include_once 'classes/util/' . $class_name . '.php';
    
    // Classes com componentes que são basicos para o funcionamento do sistema.
    include_once 'classes/componentes/' . $class_name . '.php';
}
?>
