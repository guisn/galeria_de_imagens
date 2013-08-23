<?php
$configuracao = require_once 'config.php';

function __autoload($class_name) {
    require_once 'classes/' . $class_name . '.php';
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html" />
        <link href="<?php echo $configuracao['url_do_arquivo_de_css'] ?>" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>

        <?php
        //URL onde o arquivo PHP vai ficar
        //$url_galeria = $configuracao['url_da_pasta_root_da_galeria'] . '/galeria.php';
        
        //$lista_de_imagens = ManipuladorDeImagens::geraListaDeImagensDaPasta($configuracao['pasta_das_imagens']);        

        $oImagens = new Imagens();
        $lista_de_imagens = $oImagens->listaImagensComTodasAsInformacoes();
        
//        echo '<pre style="text-align:left">';
//        var_dump($lista_de_imagens);
//        echo '</pre>';
        
        
        //Verifica se deve exibir a lista ou uma foto
        if (!isset($_GET["imagem"]) || $_GET["imagem"] === null) {
            UtilView::geraEMostraListaDeThumbnailsEmHTML($lista_de_imagens);
        } else {
            UtilView::MostraImagemEmHTML($lista_de_imagens, $_GET['imagem']);
        }
        ?>
    </body>
</html>
