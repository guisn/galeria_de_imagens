<?php

include_once 'autoload.php';

class Controlador {

    public function executa($tarefa, $parametros_da_tarefa = array()) {
        if (is_array($parametros_da_tarefa)) {
            return $this->$tarefa($parametros_da_tarefa);
        } else {
            return $this->$tarefa();
        }
        
    }

    protected function listaTodasAsImagens() {
        $Imagens = new Imagens();
        $informacoes_das_imagens = $Imagens->listaImagensComTodasAsInformacoes();
        foreach ($informacoes_das_imagens as $key => $value) {
            $informacoes_das_imagens[$key]['imagem'] = '<img src="fotos_galeria/'. $informacoes_das_imagens[$key]['arquivo'] . '" height="100" />';
            
        }

        
        
        return UtilView::converteRetornoDBEmJSONParaUI($informacoes_das_imagens);
    }
    
    

}

?>
