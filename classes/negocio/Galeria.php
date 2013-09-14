<?php

class Galeria {

    public function __construct() {
        
    }
    
    public function listaImagensComTodasAsInformacoes() {
        $ImagemDAO = new ImagemDAO();
        return $ImagemDAO->buscaTodasAsImagens();
    }
    
    public function excluiImagens($ids_das_imagens) {
        $ImagemDAO = new ImagemDAO();
        return $ImagemDAO->buscaTodasAsImagens();
    }

    
}

?>
