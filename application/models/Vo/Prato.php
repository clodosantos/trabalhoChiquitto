<?php
class Application_Model_Vo_Prato {
        private $idprato;
        private $idcategoria;
        private $descricaoprato;
        private $valorprato;
        
        function getIdprato(){
            return $this->idprato;
        }        
        function getIdcategoria(){
            return $this->idcategoria;
        }        
        function getDescricaoPrato(){
            return $this->descricaoprato;
        }        
        function getValorPrato(){
            return $this->valorprato;
        }        
        function setIdprato($idprato){
            $this->idprato = $idprato;
        }        
        function setIdcategoria($idcategoria){
            $this->idcategoria = $idcategoria;
        }        
        function setDescricaoPrato($descricaoprato){
            $this->descricaoprato = $descricaoprato;
        }        
        function setValorPrato($valorprato){
            $this->valorprato = $valorprato;
        }
    }
