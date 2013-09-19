<?php
require_once '../autoload.php';

ControleDeSessao::iniciaSessao();

if (!ControleDeSessao::usuarioLogado()) {
    UtilView::redirecionaParaUrl(URL_DA_PASTA_ROOT_DA_GALERIA . '/v/login.php');
} else {
    require_once  '../publico/html/crud_admin.php';
}

?>
