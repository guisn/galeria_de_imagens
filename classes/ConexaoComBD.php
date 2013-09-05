<?php
class ConexaoComBD {
    
    private static $CONEXAO;

    function __construct() {
        
        $dir = 'sqlite:' . CAMINHO_PARA_A_BASE_DE_DADOS_SQLITE;
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
