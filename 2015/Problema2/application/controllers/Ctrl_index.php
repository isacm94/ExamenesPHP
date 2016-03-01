<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->model('Mdl_paises'); //Cargamos modelo 
    }

    public function index($desde = 0) {
        $numpaises = $this->Mdl_paises->getNumPaises();

        $config = $this->getConfigPagTodos($numpaises);

        $paises = $this->Mdl_paises->getPaises($config['per_page'], $desde);

        $this->pagination->initialize($config);

        $enlaces = $this->GeneraEnlaces();

        $this->load->view('View_main', Array('paises' => $paises, 'numpaises' => $numpaises, 'enlaces' => $enlaces));
    }

    public function GeneraEnlaces() {
        $continentes = $this->Mdl_paises->getContinentes();
//        echo '<pre>';
//        print_r($continentes);
//        echo '</pre>';
        $enlaces = '';

        foreach ($continentes as $key => $value) {
            if ($key != 0)
                $enlaces.= '/<a href="' . site_url() . '/Ctrl_index/MuestraContinente/'.$value['continente'].'">' . $value['continente'] . '</a>';
        }

        return $enlaces;
    }

    public function MuestraContinente($continente, $desde = 0){
        
        switch ($continente){
            case 'Am%C3%A9rica':{
                $continente = 'América';
                break;
            }            
            case '%C3%81frica':{
                $continente = 'África';
                break;
            }
            case 'Ant%C3%A1rtida':{
                $continente = 'Antártida';
                break;
            }
            case 'Ocean%C3%ADa':{
                $continente = 'Ocenía';
                break;
            }           
        }
        $enlaces = $this->GeneraEnlaces();
        $numpaises = $this->Mdl_paises->getNumPaisesFromContinente($continente);
        
        $config = $this->getConfigPag($continente, $numpaises);
        $this->pagination->initialize($config);
        
        $paises = $this->Mdl_paises->getPaisesFromContinente($continente, $config['per_page'], $desde);
        
        
        $this->load->view('View_main', Array('paises' => $paises, 'numpaises' => $numpaises, 'enlaces' => $enlaces));
        
        
    }
    public function getConfigPagTodos($numpaises) {
        //Configuración de Paginación
        $config['base_url'] = site_url('/Ctrl_index/index');
        $config['total_rows'] = $numpaises;
        //$config['num_links'] = 6;
        $config['per_page'] = 20;
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

    public function getConfigPag($continente, $numpaises) {
        //Configuración de Paginación
        $config['base_url'] = site_url('/Ctrl_index/MuestraContinente/' . $continente);
        $config['total_rows'] = $numpaises;
        //$config['num_links'] = 6;
        $config['per_page'] = 20;
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

    /* echo '<pre>';
      print_r($tmpl_cuerpo);
      echo '</pre>'; */
}
