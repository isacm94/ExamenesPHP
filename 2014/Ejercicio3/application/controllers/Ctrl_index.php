<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");

        echo "<h1>Funciones Disponibles</h1>";
	echo "<pre>".print_r($client->__getFunctions(),true)."</pre>";
	
	
	echo "<h1>Tipos Disponibles</h1>";
	echo "<pre>".print_r($client->__getTypes(),true)."</pre>";
        
        $result = $client->AllPlayersWithYellowCards(true);

        // Note that $array contains the result of the traversed object structure
        //$entrenadores = $result->CoachesResult->tCoaches;
        $jugadores = $result->tPlayerNames;
        echo '<pre>';
        print_r($jugadores);
        echo '</pre>';
        
        
    }

}
