<?php

include_once '../autoload.php';

class Controlador {

    public function executa($tarefa, $parametros_da_tarefa = array()) {
        if (is_array($parametros_da_tarefa)) {
            return $this->$tarefa($parametros_da_tarefa);
        } else {
            return $this->$tarefa();
        }
        
    }
}

?>
