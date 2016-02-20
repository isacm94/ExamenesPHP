<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
        $this->load->model('Mdl_paises'); //Cargamos modelo 
    }
    public function index() {        
        //$this->load->view('View_template', Array()); 
        
        $contentXML = utf8_encode(file_get_contents('././huelvabuenasnoticias.xml'));
        //$xml = simplexml_load_string($contentXML);las dos formas funcionan        
        $xml = new SimpleXMLElement($contentXML);
        
        echo '<h3>'.$xml->channel->title.'</h3>';
        foreach ($xml->xpath('//item') as $item) {
            echo (string) $item->title. '<br>';        
        }        
    }
    
   
    
}
