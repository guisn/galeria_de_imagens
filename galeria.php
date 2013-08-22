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
        $url_galeria = $configuracao['url_da_pasta_root_da_galeria'] . '/galeria.php';
        
        //$lista_de_imagens = ManipuladorDeImagens::geraListaDeImagensDaPasta($configuracao['pasta_das_imagens']);        

        //Verifica se deve exibir a lista ou uma foto
        if (!isset($_GET["imagem"]) || $_GET["imagem"] === null) {
            
            $oImagens = new Imagens();
            
            $lista_de_imagens = $oImagens->listaImagensComTodasAsInformacoes();
            
            UtilView::geraListaDeThumbnailsComHTML($lista_de_imagens);
            
        } else {

            //Guarda o nome da imagem para montar o link da imagem grande
            $foto_g = explode("_p", $fotos[$_GET["imagens"]]);

            //Configura os links de próxima e anterior
            if ($_GET["imagens"] == 0) {
                $anterior = "";
            } else {
                $anterior = $_GET["imagens"] - 1;
            }
            if ($_GET["imagens"] == count($fotos) - 1) {
                $proxima = "";
            } else {
                $proxima = $_GET["imagens"] + 1;
            }

            //Quando solicitada uma imagem em particular, monta a <div> e insere a imagem grande de acordo com o link
            echo '<div>';
            echo '<a href="' . $url_galeria . '?imagens=' . $proxima . '">';
            echo '<img src="' . $foto_g[0] . '_g' . $foto_g[1] . '">';
            echo '</a>';
            echo '<div class="descricao-da-imagem">' . 'Aqui vai a descrição da imagem ' . $_GET["imagens"] . '</div>';
            echo "<p><a href='" . $url_galeria . "?imagens=" . $anterior . "'>Foto anterior</a> | <a href='" . $url_galeria . "'>Voltar para a galeria</a> | <a href='" . $url_galeria . "?imagens=" . $proxima . "'>Próxima foto</a></p>";
            echo '</div>';
        }
        ?>
    </body>
</html>
