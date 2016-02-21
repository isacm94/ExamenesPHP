<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
       $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index() {     
        $this->form_validation->set_error_delimiters('<span style="color: red;">', '</span>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();
        
        if ($this->form_validation->run() == FALSE){      
            $cuerpo = $this->load->view('View_form', Array(), true);
            $this->load->view('View_template', Array('tmpl_cuerpo' => $cuerpo));
        }
        else{
            $cuerpo = $this->load->view('View_form', Array(), true);
            $this->load->view('View_template', Array('tmpl_cuerpo' => $cuerpo));
        }
        if($_POST)
            print_r ($_POST);
        
    }
    
    function setMensajesErrores(){
        $this->form_validation->set_message('required', 'Hay que introducir un valor');
        $this->form_validation->set_message('min_length', 'El campo %s debe tener como mínimo %s caracteres');        
        $this->form_validation->set_message('tipo_check', 'Selecciona un tipo de coche');
        $this->form_validation->set_message('numpasajeros_check', '%s incorrecto');
    }
   
    function setReglasValidacion(){
        $this->form_validation->set_rules('matricula', 'matrícula', 'required|callback_matricula_check|min_length[4]');
        $this->form_validation->set_rules('tipo', 'tipo', 'callback_tipo_check');
        $this->form_validation->set_rules('numpasajeros', 'Número de pasajeros', 'callback_numpasajeros_check|required');
    }
    function matricula_check($matricula) {        

        $_POST['matricula'] = str_replace(' ', '', $matricula);
        
        return TRUE;
    }
    function numpasajeros_check($num){
        if($_POST['tipo'] == 'Coche' && $num >= 0 && $num <= 4){
            return true;           
        }
        
        if($_POST['tipo'] == 'Furgoneta' && $num >= 0 && $num <= 8){
            return true;           
        }
        
        if($_POST['tipo'] == 'Camion' && $num == 0){
            return true;           
        }
        return FALSE;
    }
    function numpasajerosFURGO_check($tipo){
        if($tipo == 'Furgoneta' && $_POST['numpasajeros'] >= 0 && $_POST['numpasajeros'] <= 8){
            return true;           
        }
        
        return FALSE;
    }
    function numpasajerosCAMION_check($tipo){
        if($tipo == 'Camion' && $_POST['numpasajeros'] == 0){
            return true;           
        }
        
        return FALSE;
    }
    
    function tipo_check($tipo) {        

        if($tipo != 'defecto')        
            return TRUE;
        
        return FALSE;
    }
    
    /*echo '<pre>';
                print_r($tmpl_cuerpo);
                echo '</pre>';*/
    
}
