<?php
require_once '../autoload.php';

ControleDeSessao::iniciaSessao();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html" />
        <link href="<?php echo URL_DO_ARQUIVO_DE_CSS ?>" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>

        <?php
        //URL onde o arquivo PHP vai ficar
        //$url_galeria = URL_DA_PASTA_ROOT_DA_GALERIA . '/galeria.php';
        //$lista_de_imagens = ManipuladorDeImagens::geraListaDeImagensDaPasta(PASTA_DAS_IMAGENS);        

        $galeria = new Galeria();
        $lista_de_imagens = $galeria->listaImagensComTodasAsInformacoes();

//        echo '<pre style="text-align:left">';
//        var_dump($lista_de_imagens);
//        echo '</pre>';

        //Verifica se deve exibir a lista ou uma foto
        if (!isset($_GET["imagem"]) || !is_numeric($_GET["imagem"])) {
            UtilView::geraEMostraListaDeThumbnailsEmHTML($lista_de_imagens);
        } else {
            UtilView::MostraImagemEmHTML($lista_de_imagens, $_GET['imagem']);
        }
        ?>
    </body>
</html>
