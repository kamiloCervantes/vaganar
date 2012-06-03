 <?php
 
class Cweb_View_Helper_CarreraElement extends Zend_View_Helper_FormElement{

    
    public function carreraElement($name, $value, $attribs = null){
        
        $html = '';
        
        $helper = new Zend_View_Helper_FormCheckbox();
        $helper->setView($this->view);
        
        $html.='<table>';
        $html.='<tr>';
        $html.='<td style="padding: 3.5em">';
        $html .= $helper->formCheckbox('pruebas['.$name.']',$value,null,null);
        $html.='</td>';
        $html.='<td style="width: 75%">';
        $html.='<h3>'.$attribs["titulo"].'</h3><p>Patrocina: <img src="'.$attribs["patrocinador_logo"].'"> '.$attribs["patrocinador"].'</p><p>'.$attribs["enunciado"].'</p><p>Respuesta: '.$attribs["respuesta"].'</p>';
        $html.='</td>';
        $html.='<td style="padding: 1em">';
        $html.='<img src="'.$attribs["logo"].'"><p style="font-size: 9px; text-align: center;">Logo prueba</p>';
        $html.='</td>';
        $html.='</tr>';
        $html.= "</table>";
        $html.= "<hr/>";
        
        return $html;
    }
}

?>
