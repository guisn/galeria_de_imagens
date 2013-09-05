<?php

class UtilView extends Util {

    public static function geraEMostraListaDeThumbnailsEmHTML($lista_de_imagens) {

        //Faz o loop pelo folder de imagens
        for ($i = 0; $i < count($lista_de_imagens); $i++) {

            //Cria cada uma das thumbs dentro de uma <div> com link para a imagem grande
            echo '<div class="thumb">';
            echo '<a href="' . URL_DA_PASTA_ROOT_DA_GALERIA . '/galeria.php?imagem=' . $i . '">';
            echo '<img src="' . PASTA_DAS_IMAGENS . '/' . $lista_de_imagens[$i]['arquivo'] . '">';
            echo '<div class="nome-da-imagem">' . $lista_de_imagens[$i]['nome'] . '</div>';
            echo '</a>';
            echo '</div>';
        }
    }

    public static function MostraImagemEmHTML($lista_de_imagens, $index_da_imagem) {

        $configuracao = require 'config.php';

        $bordas = self::calculaAnteriorEProximaImagem($index_da_imagem);

        //Quando solicitada uma imagem em particular, monta a <div> e insere a imagem grande de acordo com o link
        echo '<div>';
        echo '<a href="' . URL_DA_PASTA_ROOT_DA_GALERIA . '?imagens=' . $bordas['proxima'] . '">';
        echo '<img src="' . URL_DA_PASTA_ROOT_DA_GALERIA . '/' . PASTA_DAS_IMAGENS . '/' . $lista_de_imagens[$index_da_imagem]['arquivo'] . '">';
        echo '</a>';
        echo '<div class="descricao-da-imagem">' . $lista_de_imagens[$index_da_imagem]['descricao'] . '</div>';
        echo "<p><a href='" . URL_DA_PASTA_ROOT_DA_GALERIA . "/galeria.php?imagem=" . $bordas['anterior'] . "'>Foto anterior</a> | <a href='" . URL_DA_PASTA_ROOT_DA_GALERIA . "'>Voltar para a galeria</a> | <a href='" . URL_DA_PASTA_ROOT_DA_GALERIA . "/galeria.php?imagem=" . $bordas['proxima'] . "'>Próxima foto</a></p>";
        echo '</div>';
    }

    private static function calculaAnteriorEProximaImagem($index_da_imagem) {

        $anterior = '';
        $proxima = '';

        if ($index_da_imagem > 0) {
            $anterior = $index_da_imagem - 1;
        }

        if ($index_da_imagem == count($index_da_imagem) - 1) {
            $proxima = $index_da_imagem + 1;
        }


        return array('anterior' => $anterior,
            'proxima' => $proxima);
    }
    
    
    public static function redirecionaParaUrl($url) {
        header('Location: ' . $url);
    }

}

?>
