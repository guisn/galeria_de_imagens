<?php
require_once '../autoload.php';

class GaleriaControlador extends Controlador {
    
    protected function listaTodasAsImagens() {
        $galeria = new Galeria();
        $informacoes_das_imagens = $galeria->listaImagensComTodasAsInformacoes();
        foreach ($informacoes_das_imagens as $key => $value) {
            $informacoes_das_imagens[$key]['imagem'] = '<img src="../' . PASTA_DAS_IMAGENS . '/'. $informacoes_das_imagens[$key]['arquivo'] . '" height="100" />';
            
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
            
            if ($galeria->excluiImagens($ids_das_imagens)) {
                echo '{"sucesso": true}';
            }
        }
    }
    
    
    protected function insereImagem() {

        
        if ($_FILES['arquivo_da_imagem']['error'] == UPLOAD_ERR_NO_FILE) {
            throw new Exception('Nenhuma imagem foi selecionada.');
        } else if ($_FILES['arquivo_da_imagem']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['arquivo_da_imagem']['error'] == UPLOAD_ERR_FORM_SIZE) {
            throw new Exception('O servidor não permite arquivos com esse tamanho.');
        } else if ($_FILES['arquivo_da_imagem']['error'] != UPLOAD_ERR_OK) {
            throw new Exception('Houve algum problema na transmissão da imagem.');
        }
        
        
        if ($_FILES['arquivo_da_imagem']['type'] != 'image/jpeg') {
            throw new Exception('É permitido somente imagens com extensão JPG.');
        }
        
        
        $nome_do_arquivo = uniqid() . '.jpg';
        move_uploaded_file($_FILES['arquivo_da_imagem']['tmp_name'], '../' . PASTA_DAS_IMAGENS . '/' . $nome_do_arquivo);
        
        
        $dados = $_POST;
        $dados['arquivo'] = $nome_do_arquivo;
        
        $galeria = new Galeria();
        if ($galeria->insereImagem($dados)) {
            echo '{"sucesso": true}';
        }
        
    }
}

?>
