<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
    }
    public function index() {        
        //$this->load->view('View_template', Array()); 
        
        $contentXML = utf8_encode(file_get_contents('././huelvabuenasnoticias.xml'));
        //$xml = simplexml_load_string($contentXML);las dos formas funcionan        
        $xml = new SimpleXMLElement($contentXML);
        
        echo utf8_decode('<h3>'.$xml->channel->title.'</h3>');
        foreach ($xml->xpath('//item') as $item) {
            echo utf8_decode((string) $item->title). '<br>';        
        }        
    }
    
   
    
}
