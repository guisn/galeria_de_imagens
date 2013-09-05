<?php

class ControleDeSessao {

    private $alertas = array();
    public static $PERFIL_ADMINISTRADOR = 'ADMINISTRADOR';
    public static $PERFIL_OPERADOR = 'OPERADOR';
    public static $OPERACOES_PERFIL_ADMINISTRADOR = array(
        'adicionar_imagem',
        'remover_imagem',
        'alterar_descricao'
    );
    public static $OPERACOES_PERFIL_OPERADOR = array(
        'alterar_descricao'
    );
    public static $ALERTA_USUARIO_SENHA_INCORRETO = 'Usuario e/ou senha incorretos.';
    public static $ALERTA_ACESSO_NEGADO = 'Você não tem permissão para efetuar essa operação.';

    function __construct() {
        
    }
    
    public function getAlertas() {
        return $this->alertas;
    }

    protected static function getUsuarios() {

        return require 'usuarios.php';
    }

    private function declaraUsuarioNaSessao($usuario) {
        self::iniciaSessao();
        
        $_SESSION['USUARIO'] = $usuario;
        $_SESSION['PERFIL'] = $this->verificaPerfilDoUsuario($usuario);
        
        return true;
    }
    
    public static function usuarioLogado() {
        if (isset($_SESSION['USUARIO'])) {
            return true;
        }
        
        return false;
    }

    private static function verificaPerfilDoUsuario($usuario) {
        if ($usuario == 'administrador') {
            return self::$PERFIL_ADMINISTRADOR;
        } else if ($usuario == 'operador') {
            return self::$PERFIL_OPERADOR;
        }
    }

    public static function verificaPermissaoDoPerfilParaExecutarOperacao($nome_da_operacao) {
        if (session_status() != PHP_SESSION_ACTIVE) {
            return false;
        }
        
        if (array_search($nome_da_operacao, self::$OPERACOES_PERFIL_ADMINISTRADOR));
    }

    public function autenticaUsuario($argumento_usuario, $argumento_senha) {

        $usuarios_e_senhas = self::getUsuarios();

        if (!is_array($usuarios_e_senhas)) {
            throw new Exception('Arquivo de usuarios existe, porém está vazio.');
        }

        if (!isset($usuarios_e_senhas[$argumento_usuario])) {
            $this->adicionaAlerta(self::$ALERTA_USUARIO_SENHA_INCORRETO);
            return false;
        }

        if ($usuarios_e_senhas[$argumento_usuario] != $argumento_senha) {
            $this->adicionaAlerta(self::$ALERTA_USUARIO_SENHA_INCORRETO);
            return false;
        }
        
        if (!$this->declaraUsuarioNaSessao($argumento_usuario)) {
            return false;
        }
        
        return true;
    }

    protected function adicionaAlerta($erro) {
        if ($erro == '') {
            throw new Exception('Argumento inválido.');
        }

        $this->alertas[] = $erro;
    }

    protected function limpaAlertas() {
        $this->alertas = array();
    }
    
    public static function iniciaSessao() {        
        session_name('galeria_de_imagens');
        session_start();
    }
    
    public static function reiniciaSessao() {
        session_destroy();
        session_name('galeria_de_imagens');
        session_start();
    }
    
    public static function destroiSessao() {
        session_destroy();
    }
    
    

}
