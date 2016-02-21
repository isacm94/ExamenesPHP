<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ctrl_index extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");

//        echo "<h1>Funciones Disponibles</h1>";
//	echo "<pre>".print_r($client->__getFunctions(),true)."</pre>";
//	
//	
//	echo "<h1>Tipos Disponibles</h1>";
//	echo "<pre>".print_r($client->__getTypes(),true)."</pre>";
        
        $result = $client->AllPlayersWithYellowCards(array('bSortedByName' => true, 'bSortedByYellowCards' => false));

        // Note that $array contains the result of the traversed object structure
        //$entrenadores = $result->CoachesResult->tCoaches;
        $jugadores = $result->AllPlayersWithYellowCardsResult->tPlayersWithCards;
        
        echo '<h1>Jugadores con tarjetas amarillas</h1>';
        foreach ($jugadores as $key => $value) {
            echo  $value->sName.' - '.$value->iYellowCards.'<br>';
        }
//        echo '<pre>';
//        print_r($jugadores);
//        echo '</pre>';
        
        
    }

}
