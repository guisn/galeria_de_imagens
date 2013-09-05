<?php
require_once 'autoload.php';

if (ControleDeSessao::usuarioLogado()) {
    UtilView::redirecionaParaUrl(URL_DA_PASTA_ROOT_DA_GALERIA . '/area_admin.php');
}

// Se caso houver tentativa de login
if (is_array($_POST['formulario_de_login'])) {
    $login = new ControleDeSessao();
    
    if ($login->autenticaUsuario($_POST['formulario_de_login']['usuario'], $_POST['formulario_de_login']['senha'])) {
        UtilView::redirecionaParaUrl(URL_DA_PASTA_ROOT_DA_GALERIA . '/area_admin.php');
    }

    // Mostra alertas do login
    if (isset($login) && is_array($login->getAlertas())) :
        echo '<ul>';
        foreach ($login->getAlertas() as $alerta) {
            echo '<li>' . $alerta . '</li>';
        }
        echo '</ul>';
    //echo '<a href="' . $configuracao['url_da_pasta_root_da_galeria'] . '/area_admin.php">Voltar ao login</a> ou <a href="">Voltar a pagina inicial</a>';
    endif;
}



require_once URL_DO_FORMULARIO_DE_LOGIN;
