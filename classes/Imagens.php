<?php

class Imagens {

    public function __construct() {
        
    }
    
    public function listaImagensComTodasAsInformacoes() {
        $ImagemDAO = new ImagemDAO();
        return $ImagemDAO->buscaTodasAsImagens();
    }

    
}

?>
