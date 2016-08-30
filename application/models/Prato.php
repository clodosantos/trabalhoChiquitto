<?php
class Application_Model_Prato {
    public function apagar($idprato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->delete("idprato = $idprato");
            return true;
        }
        public function atualizar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'descricaoprato' => $prato->getDescricaoPrato()
            ), 'idprato = '.$prato->getIdprato());
            
            return true;
        }
        public function atualizarGeral(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->update(array(
                'idcategoria' => $prato->getIdcategoria(),
                'descricaoprato' => $prato->getDescricaoPrato(),
                'valorprato' => $prato->getValorPrato()
            ), 'idprato = '.$prato->getIdprato());
            
            return true;  
        }
        public function salvar(Application_Model_Vo_Prato $prato){
            $tab = new Application_Model_DbTable_Prato();
            $tab->insert(array(
                'idprato' => $prato->getIdprato(),
                'idcategoria' => $prato->getIdcategoria(),
                'descricaoprato' => $prato->getDescricaoPrato(),
                'valorprato' => $prato->getValorPrato()
            ));
                    
            $id = $tab->getAdapter()->lastInsertId();
            $prato->setIdprato($id);
            return true;
        }
    }
