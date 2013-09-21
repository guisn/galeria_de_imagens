<?php
class UtilInjection extends Util {

    public static function anti_injection_geral($argumento) {

        if (is_array($argumento)) {
            $array_seguro = self::anti_injection_para_array_de_um_nivel($argumento);
            return $array_seguro;
            
            // Fim
        }

        $argumento = self::limpa_injection($argumento);
        
        return $argumento;
    }

    protected static function anti_injection_para_array_de_um_nivel(array $argumento) {
        
        foreach ($argumento as $chave => $valor) {
            
            if (is_array($valor)) {
                 $valor = self::anti_injection_para_array_de_um_nivel($valor);
            }

            $argumento[$chave] = self::limpa_injection($valor);
            
        }
        return $argumento;
    }
    
    protected static function limpa_injection($argumento) {
        // remove palavras que contenham sintaxe sql
        //$valor = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $sql);
        
        $argumento = trim($argumento); //limpa espaços vazio
        $argumento = strip_tags($argumento); //tira tags html e php
        $argumento = addslashes($argumento); //Adiciona barras invertidas a uma string
        $argumento = "'" . $argumento . "'";
        
        return $argumento;
    }
    
    
    public static function limpaXSS($argumento) {
        return self::limpa_injection($argumento);
    }

}

?>
