<?php

class PratoController extends Blog_Controller_Action {

    public function indexAction() {
           $tab = new Application_Model_DbTable_Prato();
           $consulta = $tab->getAdapter()->select();
           $consulta->from(array(
                                        'p' => "pratos"
                                ), array(
                                        "idprato",
                                        "descricaoprato",
                                        "valorprato"
                                ));

           $consulta->joinInner(array("c" =>"categoria"), "c.idcategoria = p.idcategoria", array(
                                         "categoria"
                                ));
           $consulta->where("p.idcategoria > ?", 0, Zend_Db::INT_TYPE);
           $consultaBd = $consulta->query()->fetchAll();
           $this->view->podeApagar = $this->aclIsAllowed('prato', 'delete');

           $this->view->pratos = $consultaBd;
    }
    public function createAction() {
                $frm = new Application_Form_Prato();

                if ($this->getRequest()->isPost()) {
                    $params = $this->getAllParams();

                    if ($frm->isValid($params)) {
                        $params = $frm->getValues();

                        $prato = new Application_Model_Vo_Prato();
                        $prato->setDescricaoPrato($params['descricaoprato']);
                        $prato->setIdcategoria($params['idcategoria']);

                        $model = new Application_Model_Prato();
                        $model->salvar($prato);

                        $flashMessendge = $this->_helper->FlashMessenger;
                        $flashMessendge->addMessage("Prato salvo");

                        $this->_helper->Redirector->gotoSimpleAndExit('index');
                    }
                }

                $this->view->frm = $frm;
            }

            public function deleteAction() {
                $idprato = (int)$this->getParam('idprato', 0);
                $model = new Application_Model_Prato();
                $model->apagar($idprato);

                $flashMessenger = $this->_helper->FlashMessenger;
                $flashMessenger->addMessage('Registro apagado');

                $this->_helper->Redirector->gotoSimpleAndExit('index');
            }

            public function updateAction() {
                $idprato = (int)  $this->getParam('idprato', 0);

                $tab = new Application_Model_DbTable_Prato();
                $row = $tab->fetchRow('idprato = '.$idprato);

                if($row === null){
                    echo "prato inexistente";
                    exit;
                }

                $podeEntrar = $this->aclIsAllowed('usuario', 'delete');

                if($podeEntrar){
                    $frm = new Application_Form_PratoGeral();
                }else{
                    $frm = new Application_Form_Prato();
                }


                if($this->getRequest()->isPost()){
                    $params = $this->getAllParams();

                    if($frm->isValid($params)){
                        $params = $frm->getValues();

                        $prato = new Application_Model_Vo_Prato();
                        $prato->setDescricaoPrato($params['descricaoprato']);
                        $prato->setValorPrato($params['valorprato']);
                        $prato->setIdcategoria($params['idcategoria']);
                        $prato->setIdprato($idprato);

                        $model = new Application_Model_Prato();
                        if($podeEntrar){
                            $model->atualizarGeral($prato);
                        }
                        else{
                            $model->atualizar($prato);
                        }
                        $flashMessendge =  $this->_helper->FlashMessenger;
                        $flashMessendge->addMessage("O Prato foi salvo");

                        $this->_helper->Redirector->gotoSimpleAndExit('index');
                    }
                } else{
                    $frm->populate(array(
                        'descricaoprato' =>$row->descricaoprato,
                        'valorprato' =>$row->valorprato,
                        'idcategoria' =>$row->idcategoria
                    ));
                }

                $this->view->frm = $frm;
            }
}
