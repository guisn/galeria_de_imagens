<?php
$configuracao = require_once 'config.php';

// Se caso houver tentativa de login
if (is_array($_POST['formulario_de_login'])) {

    require_once './classes/ControleDeSessao.php';
    $login = new ControleDeSessao();

    if ($login->autenticaUsuario($_POST['formulario_de_login']['usuario'], $_POST['formulario_de_login']['senha'])) {
        header('Location: ' . $configuracao['url_da_pasta_root_da_galeria'] . '/galeria.php');
    }
}

if (isset($login) && is_array($login->getAlertas())) :
    echo '<ul>';
    foreach ($login->getAlertas() as $alerta) {
        echo '<li>' . $alerta . '</li>';
    }
    echo '</ul>';
    //echo '<a href="' . $configuracao['url_da_pasta_root_da_galeria'] . '/area_admin.php">Voltar ao login</a> ou <a href="">Voltar a pagina inicial</a>';
endif;


echo file_get_contents($configuracao['url_do_formulario_de_login']);
?>
