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
        return $ImagemDAO->excluiImagens($ids_das_imagens);
    }
    
    public function alteraDadosDaImagem($dados) {
        $ImagemDAO = new ImagemDAO();
        return $ImagemDAO->excluiImagens($ids_das_imagens);
    }

    public function insereImagem($dados) {
        
        $dados_filtrados['nome'] = $dados['nome'];
        $dados_filtrados['ordem'] = $dados['ordem'];
        $dados_filtrados['descricao'] = $dados['descricao'];
        $dados_filtrados['arquivo'] = $dados['arquivo'];
        
        $ImagemDAO = new ImagemDAO();
        return $ImagemDAO->insereImagem($dados_filtrados);
    }
    
}

?>
