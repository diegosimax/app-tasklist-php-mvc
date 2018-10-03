<?php
    
    /**
     * Fonte: Responsável pela Model de Tarefa.
     * Autor: Diego Simas.
     * Data : 02/10/2018
     */

    class Tarefa
    {
        
        private $atributos;    

        public function __construct(){            
        }

        public function __set(string $atributo, $valor){
            $this->atributos[$atributo] = $valor;
            return $this;
        }

        public function __get(string $atributo){
            return $this->atributos[$atributo];
        }

        public function __isset(string $atributo ){
            return isset($this->atributos[$atributo]);
        }

        //Salvar a Tarefa
        public function save(){
            
            $colunas = $this->preparar($this->$atributos);
            
            if(!isset($this->id)){ //Se não existir é um registro novo
                $query = "INSERT INTO tb_task (".
                    implode(', ', array_keys($colunas)).
                    ") VALUES (".
                    implode(', ', array_values($colunas)).");";            
            }else{ //Se existe então altera o registro    
                foreach ($colunas as $key => $value) {
                    if($key !== 'id'){
                        $camposAlterar[] = "{$key}={$value}";                        
                    }
                }
                $query = "UPDATE tb_task SET ".
                    implode(', ', $camposAlterar).
                    " WHERE id='{$this->id}';";
            }
            if ($conexao = Conexao::getInstance()){
                $stmt = $conexao->prepare($query);
                if($stmt->execute()){ //Caso o statement retorne ok retornamos verdadeiro                    
                    return true;
                }
            }
            return false;
        }

        /**
         * Transformar dados em string
         */
        private function converteDados($data){
            if(is_string($data) & !empty($data)){
                return "'".addslashes($data)."'";                
            }elseif (is_bool($data)){
                return $data ? 'TRUE' : 'FALSE';
            }elseif ($data !== ''){
                return $data;
            }else{
                return 'NULL';
            }
        }
        
        /**
         * Preparar dados
         */
        private function prepararDados($data){
            $retorno = array();
            foreach ($data as $k => $v) {
                if (is_scalar($v)) {
                    $retorno[$k] = $this->escapar($v);
                }
            }
            return $retorno;
        }

    }
    

    

?>