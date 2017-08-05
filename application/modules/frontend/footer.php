<?php
class footer extends Module{
    function script(){
        $js = array(
            'header' => array(
                
            ),
            'footer' => array(                
                'frontend/footer.js'
            )   
        );
        $css = array(
            'cars/main.css',
            'cars/font-awesome.css'
        );        
        return array('js'=>$js,'css'=>$css);
    }
    function draw(){
    	$assign = array(
            'skin_front' => SKIN_CAR          
        );
        $this->load->skins('frontend');
        return $this->smarty->display_module('footer/footer.html');
    }
}
?>