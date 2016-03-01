<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
    }
    public function index() {        
        //$this->load->view('View_template', Array()); 
        
        $contentXML = utf8_encode(file_get_contents('././cursos.xml'));
        //$xml = simplexml_load_string($contentXML);las dos formas funcionan        
        $xml = new SimpleXMLElement($contentXML);


        foreach ($xml->xpath('//curso') as $curso) {
            if ((string) $curso->category == '7')
                echo utf8_decode((string) $curso->fullname) . '<br>';
        }
    }
    
   
    
}
