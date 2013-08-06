<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html" />
        <title></title>
        <link href="estilo.css" media="screen" rel="stylesheet" type="text/css">
    </head>
    <body>

        <?php
        $configuracao = require_once 'config.php';

        //URL onde o arquivo PHP vai ficar
        $url_galeria = $configuracao['url_da_pasta_root_da_galeria'] . '/galeria.php';

        //URL onde o arquivo PHP vai ficar
        $pasta_imagens = $configuracao['pasta_das_imagens'];

        //Início da função

        $fotos = array();

        $caminhos_dos_arquivos = glob($pasta_imagens . '/{*_p.jpg,*_p.gif}', GLOB_BRACE);

        //Loop que percorre a pasta das imagens e armazena o nome de todos os arquivos
        foreach ($caminhos_dos_arquivos as $imagens) {

            $fotos[] = $imagens;
        }

        //Verifica se deve exibir a lista ou uma foto
        if (@$_GET["imagens"] == "") {

            //Faz o loop pelo folder de imagens
            for ($i = 0; $i < count($fotos); $i++) {

                //Cria cada uma das thumbs dentro de uma <div> com link para a imagem grande
                echo "<div class='thumb'>";
                echo "<a href='" . $url_galeria . "?imagens=" . $i . "'>";
                echo "<img src='" . $fotos[$i] . "'>";
                echo "</a>";
                echo "</div>";
            }
        } else {

            //Guarda o nome da imagem para montar o link da imagem grande
            $foto_g = explode("_p", $fotos[@$_GET["imagens"]]);

            //Configura os links de próxima e anterior
            if (@$_GET["imagens"] == 0) {
                $anterior = "";
            } else {
                $anterior = @$_GET["imagens"] - 1;
            }
            if (@$_GET["imagens"] == count($fotos) - 1) {
                $proxima = "";
            } else {
                $proxima = @$_GET["imagens"] + 1;
            }

            //Quando solicitada uma imagem em particular, monta a <div> e insere a imagem grande de acordo com o link
            echo "<div>";
            echo "<a href='" . $url_galeria . "?imagens=" . $proxima . "'>";
            echo "<img src='" . $foto_g[0] . "_g" . $foto_g[1] . "'>";
            echo "</a>";
            echo "<p><a href='" . $url_galeria . "?imagens=" . $anterior . "'>Foto anterior</a> | <a href='" . $url_galeria . "'>Voltar para a galeria</a> | <a href='" . $url_galeria . "?imagens=" . $proxima . "'>Próxima foto</a></p>";
            echo "</div>";
        }
        ?>
    </body>
</html>
