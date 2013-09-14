<?php

class UtilManipulacaoDeImagens {

    function __construct() {
        
    }

    public static function modificaTamanhoDaImagem($nome_img, $lar_maxima, $alt_maxima, $qualidade = 100) {

        if ($qualidade == '') {
            $qualidade = 100;
        }

        $size = getimagesize($nome_img);
        $tipo = $size[2];

        # Pega onde est� a imagem e carrega	 
        if ($tipo == 2) { // 2 � o JPG
            $img = imagecreatefromjpeg($nome_img);
        } if ($tipo == 1) { // 1 � o GIF
            $img = imagecreatefromgif($nome_img);
        } if ($tipo == 3) { // 3 � PNG
            $img = imagecreatefrompng($nome_img);
        }


        // Se a imagem foi carregada com sucesso, testa o tamanho da mesma
        if ($img) {
            // Pega o tamanho da imagem e propor��o de resize
            $width = imagesx($img);
            $height = imagesy($img);
            $scale = min($lar_maxima / $width, $alt_maxima / $height);

            // Se a imagem � maior que o permitido, encolhe ela!
            if ($scale < 1) {
                $new_width = floor($scale * $width);
                $new_height = floor($scale * $height);

                // Cria uma imagem tempor�ria
                $tmp_img = imagecreatetruecolor($new_width, $new_height);

                // Copia e resize a imagem velha na nova
                imagecopyresampled($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                // imagedestroy($img);
                $img = $tmp_img;
            }
        }

        imagejpeg($img, '', $qualidade);

        imagedestroy($img);
    }

    static public function geraListaDeImagensDaPasta($pasta_imagens) {
        $fotos = array();

        $caminhos_dos_arquivos = glob($pasta_imagens . '/{*.jpg,*.gif}', GLOB_BRACE);

        //Loop que percorre a pasta das imagens e armazena o nome de todos os arquivos
        foreach ($caminhos_dos_arquivos as $imagem) {
            $arrayCaminhoImagem = explode('/', $imagem);

            $fotos[] = $arrayCaminhoImagem[1];
        }

        return $fotos;
    }

}