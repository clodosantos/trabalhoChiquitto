<?php
class Application_Form_Prato extends Zend_Form {
    public function init() {        
        $this->setMethod('post');
        $prato = new Zend_Form_Element_Text('descricaoprato' , array(
            'label' => 'DESCRICAO DO PRATO',
            'required' => true
        ));
        $prato->addFilter(new Zend_Filter_StringToUpper());
        
        $this->addElement($prato);
        
        
        
        $categoria = new Zend_Form_Element_Select('idcategoria', array(
            'label' => "CATEGORIA",
            'required' =>true
        ));
        
        $this->addElement($categoria);

        $categoria->setMultiOptions($this->pegarCategorias());
        
        $filtro = new Zend_Filter_Null();
        $categoria->addFilter($filtro);
        
        $botao = new Zend_Form_Element_Submit('botao', array(
            'label'=>'SALVAR'
        ));
        
        $this->addElement($botao);
        
       
    }
    private function pegarCategorias(){
        $tab = new Application_Model_DbTable_Categoria();
        $categorias = $tab->fetchAll()->toArray();
        
        $options = array();
        $options[0] = "Selecione";
        foreach ($categorias as $item) {
            $idcategoria = $item['idcategoria'];
            $nomecategoria = $item['categoria'];
            
            $options[$idcategoria] = $nomecategoria;
        }
        
        
        return $options;
    }

}
