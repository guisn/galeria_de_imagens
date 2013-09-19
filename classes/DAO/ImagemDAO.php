<?php
class ImagemDAO extends DAO {

    function __construct() {
        parent::__construct();
    }
    
    public function buscaImagemPorNomeDoArquivo($nome_do_arquivo) {
        /*
        $sql = "INSERT INTO imagem (arquivo, nome, descricao, ordem)
                VALUES ('safe_image.jpg', 'aaaaaa', 'asdhiasd', null)";
        if (!$this->db->query($sql)) {
            echo '<pre>';
            var_dump($this->db->errorInfo());
            echo '</pre>';
            
        } else {
            echo 'foi';
        }
         * 
         */
        
        $sql = 'SELECT *
                  FROM imagem
                 WHERE arquivo IN (' . implode(',', UtilInjection::anti_injection_geral($nome_do_arquivo)) . ')';

        //$sql = 'select count() from imagem';
        $retorno = $this->CONEXAO()->query($sql);
        if ($retorno === false) {
            throw new Exception('Falha ao carregar as imagens.');
        }
        
        return $retorno->fetchAll();
    }
    
    public function buscaImagemPorId($id_da_imagem) {
        
        $sql = 'SELECT *
                  FROM imagem
                 WHERE arquivo IN (' . implode(',', UtilInjection::anti_injection_geral($id_da_imagem)) . ')';

        //$sql = 'select count() from imagem';
        $retorno = $this->CONEXAO()->query($sql);
        if ($retorno === false) {
            throw new Exception('Falha ao carregar as imagens.');
        }
        
        return $retorno->fetchAll();
    }
    
    public function buscaTodasAsImagens() {
        
        $sql = 'SELECT *
                  FROM imagem
              ORDER BY ordem';

        //$sql = 'select count() from imagem';
        $retorno = $this->CONEXAO()->query($sql);
        if ($retorno === false) {
            throw new Exception('Falha ao carregar as imagens.');
        }
        return $retorno->fetchAll(2);
    }
    
    public function excluiImagens($ids_das_imagens) {
        
        $sql = 'DELETE
                  FROM imagem
                 WHERE id IN (' . implode(',', UtilInjection::anti_injection_geral($ids_das_imagens)) . ')';

        //$sql = 'select count() from imagem';
        $retorno = $this->CONEXAO()->query($sql);
        if ($retorno === false) {
            throw new Exception('Falha ao excluir imagens.');
        }
        return true;
    }
    
    public function atualizaImagem($campos_e_valores) {
        
        foreach ($campos_e_valores as $campo => $valor) {
            $sets = $campo . '=' . UtilInjection::anti_injection_geral($valor);
            echo '<pre>';
            var_dump($sets);
            echo '</pre>';
            exit;
        }
        
        
        $sql = 'UPDATE imagem ' . implode(',', UtilInjection::anti_injection_geral($campos)) . ')
                 WHERE id IN (' . implode(',', UtilInjection::anti_injection_geral($ids_das_imagens)) . ')';

        //$sql = 'select count() from imagem';
        $retorno = $this->CONEXAO()->query($sql);
        if ($retorno === false) {
            throw new Exception('Falha ao excluir imagens.');
        }
        return true;
    }

}
?>
