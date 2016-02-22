<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mdl_paises'); //Cargamos modelo 
        $this->load->library('email');
    }

    public function index() {
        include_once '././usuarios.php';

//        echo '<pre>';
//        print_r($listaReceptoresDeCorreo);
//        echo '<pre>';

        foreach ($listaReceptoresDeCorreo as $key => $value) {
            $this->email->from('aula4@iessansebastian.com', 'Correo para ' . $value->Nombre());
            $this->email->to($value->Direccion());

            $this->email->subject('Ejercicio 5 Ex. 2014 - Problema 6 Ex. 2015');

            $this->email->message("<h1 style='color: red;'>Hola Mundo!</h1>");

            if (!$this->email->send())
                echo "<pre>\n\nError enviado mail\n</pre>";
            else
                echo "<pre>\n\nMail enviado correctamente\n</pre>";
        }

    }

}
