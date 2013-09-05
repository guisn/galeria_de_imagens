<?php
require_once 'autoload.php';

ControleDeSessao::iniciaSessao();
if (!ControleDeSessao::usuarioLogado()) {
    
    UtilView::redirecionaParaUrl('login.php');
} else {
    require_once 'publico/html/crud_admin.php';
}

?>
