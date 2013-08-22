<?php
class UtilView extends Util {
    
    public static function geraListaDeThumbnailsComHTML() {
        //Faz o loop pelo folder de imagens
        for ($i = 0; $i < count($lista_de_imagens); $i++) {

            //Cria cada uma das thumbs dentro de uma <div> com link para a imagem grande
            echo '<div class="thumb">';
            echo '<a href="' . $url_galeria . '?imagens=' . $i . '">';
            echo '<img src="' . $configuracao['pasta_das_imagens'] . '/' . $lista_de_imagens[$i] . '">';
            echo '<div class="nome-da-imagem">' . 'Nome da imagem' . '</div>';
            echo '</a>';
            echo '</div>';
        }
    }

}
?>
