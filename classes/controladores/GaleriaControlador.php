<?php
require_once '../autoload.php';

class GaleriaControlador extends Controlador{
    protected function listaTodasAsImagens() {
        $galeria = new Galeria();
        $informacoes_das_imagens = $galeria->listaImagensComTodasAsInformacoes();
        foreach ($informacoes_das_imagens as $key => $value) {
            $informacoes_das_imagens[$key]['imagem'] = '<img src="fotos_galeria/'. $informacoes_das_imagens[$key]['arquivo'] . '" height="100" />';
            
        }
        return UtilView::converteRetornoDBEmJSONParaUI($informacoes_das_imagens);
    }
    
    
    protected function excluiImagens($imagens) {
        if (is_array($imagens)) {
            $galeria = new Galeria();
            
            $ids_das_imagens = array();
            foreach ($imagens as $valores) {
                $ids_das_imagens[] = $valores['id'];
            }
            
            $galeria->excluiImagens($ids_das_imagens);
        }
    }
}

?>
