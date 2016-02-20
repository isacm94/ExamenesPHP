<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
        $this->load->model('Mdl_paises'); //Cargamos modelo 
    }
    public function index() {
        
        $this->load->view('View_template', Array()); 
        $this->CreaPDF_Pedido(); 
        
    }
    
   private function CreaPDF_Pedido() {
        $this->load->library('PDF', 0, 'myPDF');

        $this->myPDF->AddPage();
        $this->myPDF->AliasNbPages(); //nº de páginas
        $this->myPDF->SetFont('Arial', '', 10);
        
        $numpaises = $this->Mdl_paises->getNumPaises();
        $paises = $this->Mdl_paises->getPaises();
        
        
        /*echo '<pre>';
        print_r($paises);
        echo '</pre>';*/
        $this->myPDF->ImprovedTable(array('Nº', 'Nombre', 'Continente'), $paises);
        
        $this->myPDF->Ln('20');
        $this->myPDF->Cell(0, 0, utf8_decode("Número de países: ".$numpaises), 0, 1);
        

        $this->myPDF->Output();
    }
    
}
