<?php

class DAO extends ConexaoComBD {

    public function __construct() {
        parent::__construct();

        $this->verificaIntegridadeDaBaseDeImagens();
    }

    private function reconstroiTabelas() {
        $create_table = 'CREATE TABLE imagem ( 
                                    id                INTEGER         PRIMARY KEY      AUTOINCREMENT,
                                    arquivo           VARCHAR( 255 )  NOT NULL,
                                    nome              VARCHAR( 255 ),
                                    descricao         VARCHAR( 255 ),
                                    ordem             INT             UNIQUE 
                                );';
        $this->CONEXAO()->exec($create_table);
    }

    protected function verificaIntegridadeDaBaseDeImagens() {

        $sql = 'select 1 from imagem';

        if (!$this->CONEXAO()->query($sql)) {
            $this->reconstroiTabelas();
        }
    }

    protected final function CONEXAO() {
        return parent::CONEXAO();
    }

}

?>
