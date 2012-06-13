 <?php
 
class Cweb_View_Helper_AsociacionElement extends Zend_View_Helper_FormElement{

    
    public function asociacionElement($name, $value = null, $attribs = null){
        
        $html = '';
        
        $helper = new Zend_View_Helper_FormCheckbox();
        $helper->setView($this->view);
        
        $html.='<div id="'.$name.'-controls'.'" style="margin-bottom: 5px;"><a name="'.$name.'-agregar'.'" id="'.$name.'-agregar'.'" class="btn btn-mini" href="#add-'.$name.'"><i class="icon-plus"></i></a><a name="'.$name.'-quitar'.'" id="'.$name.'-quitar'.'" class="btn btn-mini" href="#quitar-'.$name.'"><i class="icon-minus"></i></a></div>';
        $html.='<table class="table table-striped" name="'.$name.'" id="'.$name.'">';
        $html.='<tr>';
        for($i=0;$i<$attribs['campos'];$i++){
            $html.='<th>';
            $html.=$attribs['campo_'.($i+1)];
            $html.='</th>';
        }
        $html.='</tr>';
        $html.= '</table>';
        
        return $html;
    }
}

?>
