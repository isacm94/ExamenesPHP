<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

     public function __construct() {
        parent::__construct();    
       $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('pagination');
        $this->load->model('Mdl_paises'); //Cargamos modelo 
        $this->load->library('form_validation');
    }
    public function index($desde = 0) {
        $numpaises = $this->Mdl_paises->getNumPaises();
        $config = $this->getConfigPagTodos($numpaises);
        $paises = $this->Mdl_paises->getPaises($config['per_page'], $desde);
        
        $continentes = $this->Mdl_paises->getContinentes();                   
        
        $this->pagination->initialize($config);        
        
        $this->load->view('View_template', Array('tmpl_menu' => $continentes, 'tmpl_cuerpo'=>$paises, 'continente' => '', 'numpaises' => $numpaises)); 
        
    }
    
    public function MostrarContinente($nomcont, $desde = 0){
        $continentes = $this->Mdl_paises->getContinentes();
       
        switch ($nomcont){
            case 'Am%C3%A9rica':{
                $nomcont = 'América';
                break;
            }            
            case '%C3%81frica':{
                $nomcont = 'África';
                break;
            }
            case 'Ant%C3%A1rtida':{
                $nomcont = 'Antártida';
                break;
            }
            case 'Ocean%C3%ADa':{
                $nomcont = 'Ocenía';
                break;
            }           
        }
        
        $config = $this->getConfigPag($nomcont);
        
        $this->pagination->initialize($config);
                
        $paises = $this->Mdl_paises->getPaisesFromContinente($nomcont, $config['per_page'], $desde);
        $numpaises = $this->Mdl_paises->getNumPaisesFromContinente($nomcont);
        
        $this->load->view('View_template', Array('tmpl_menu' => $continentes, 'tmpl_cuerpo'=>$paises, 'continente'=>$nomcont, 'numpaises' => $numpaises)); 
        
    }
    
    public function Editar($id){
        $continentes = $this->Mdl_paises->getContinentes();
        
        $this->form_validation->set_error_delimiters('<span style="color: red;">', '</span>');
        $this->setMensajesErrores();
        $this->setReglasValidacion();
        
        if ($this->form_validation->run() == FALSE){
        
            $cuerpo = $this->load->view('View_editar', array('id' => $id), true);
        
            $this->load->view('View_template', Array('tmpl_menu' => $continentes, 'cuerpo' => $cuerpo));
        }
        else{
            $pais = Array(
                'nombre' => $_POST['pais'],
                'iso2' => $_POST['iso2'],
                'iso3' => $_POST['iso3'] ,
                'continente' => $_POST['continente']
            );
            
            $this->Mdl_paises->ActualizaPais($pais, $id);
            redirect('', 301, 'Location');
        }
    }
    
    function setMensajesErrores(){
        $this->form_validation->set_message('required', 'Hay que introducir un valor');
        $this->form_validation->set_message('alpha', 'Sólo caracteres alfabéticos');
        $this->form_validation->set_message('exact_length', 'El campo %s debe tener %s caracteres');
        $this->form_validation->set_message('continente_check', 'Debe ser un continente válido');
    }
   
    function setReglasValidacion(){
        $this->form_validation->set_rules('pais', 'país', 'required|alpha');
        $this->form_validation->set_rules('iso2', 'ISO 2', 'required|exact_length[2]');
        $this->form_validation->set_rules('iso3', 'ISO 3', 'required|exact_length[3]');
        $this->form_validation->set_rules('continente', ' continente ', 'required|callback_continente_check');
    }
    function continente_check($continente) {        

        if ($continente == "África" || $continente == "América" || $continente == "Antártida" || $continente == "Asia"
                || $continente == "Europa" || $continente == "Ocenía") {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function getConfigPag($nomcont){
        //Configuración de Paginación
        $config['base_url'] = site_url('/Ctrl_index/MostrarContinente/'.$nomcont);
        $config['total_rows'] = $this->Mdl_paises->getNumPaisesFromContinente($nomcont);
        //$config['num_links'] = 6;
        $config['per_page'] = 10;
        $config['uri_segment'] = 4;

        $config['full_tag_open'] = '<span>';
        $config['full_tag_close'] = '</span>';
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $config['prev_tag_open'] = '<span>';
        $config['prev_tag_close'] = '</span>';
        $config['next_tag_open'] = '<span>';
        $config['next_tag_close'] = '</span>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<span>';
        $config['first_tag_close'] = '</span>';
        $config['last_tag_open'] = '<span>';
        $config['last_tag_close'] = '</span>';
    
        return $config;
    }
    
    public function getConfigPagTodos($numpaises){
        //Configuración de Paginación
        $config['base_url'] = site_url('/Ctrl_index/index');
        $config['total_rows'] = $numpaises;
        //$config['num_links'] = 6;
        $config['per_page'] = 50;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<span>';
        $config['full_tag_close'] = '</span>';
        $config['num_tag_open'] = '<span>';
        $config['num_tag_close'] = '</span>';
        $config['cur_tag_open'] = '<span>';
        $config['cur_tag_close'] = '</span>';
        $config['prev_tag_open'] = '<span>';
        $config['prev_tag_close'] = '</span>';
        $config['next_tag_open'] = '<span>';
        $config['next_tag_close'] = '</span>';
        $config['first_link'] = '«';
        $config['prev_link'] = '‹';
        $config['last_link'] = '»';
        $config['next_link'] = '›';
        $config['first_tag_open'] = '<span>';
        $config['first_tag_close'] = '</span>';
        $config['last_tag_open'] = '<span>';
        $config['last_tag_close'] = '</span>';
    
        return $config;
    }
    
    /*echo '<pre>';
                print_r($tmpl_cuerpo);
                echo '</pre>';*/
    
}
