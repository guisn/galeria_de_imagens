<?php
class ConexaoComBD {
    
    private static $CONEXAO;

    function __construct() {
        $configuracao = require './config.php';
        
        $dir = 'sqlite:' . $configuracao['caminho_para_a_base_de_dados_sqlite'];
        $dbh = new PDO($dir);
        
        if (!$dbh) {
            throw new Exception('Conexão inválida.');
        }
        
        if (self::$CONEXAO === null) {
            self::$CONEXAO = $dbh;
        }
        
        
    }
    
    
    protected function CONEXAO() {
        return self::$CONEXAO;
    }   
    

}
?>
