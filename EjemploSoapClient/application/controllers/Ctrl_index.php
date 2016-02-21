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
//	echo "<h1>Tipos Disponibles</h1>";
//	echo "<pre>".print_r($client->__getTypes(),true)."</pre>";
        
        $result = $client->AllPlayersWithRedCards(array('bSortedByName' => true, 'bSortedByRedCards'=> false));
        $rojas = $result->AllPlayersWithRedCardsResult->tPlayersWithCards;
        
        echo '<h1>Jugadores con tarjetas rojas</h1>';
        foreach ($rojas as $key => $value) {
            echo $value->sName . '<br>';
        }

        //--------------------------------------------------------------------------------------------------------------
        $result = $client->AllPlayersWithYellowCards(array('bSortedByName' => true, 'bSortedByYellowCards'=> false));
        $amarillas = $result->AllPlayersWithYellowCardsResult->tPlayersWithCards;
        
        echo '<h1>Jugadores con tarjetas amarillas</h1>';
        foreach ($amarillas as $key => $value) {
            echo $value->sName . '<br>';
        }
        
        //--------------------------------------------------------------------------------------------------------------
        $result = $client->AllGoalKeepers(array('sCountryName' => false));
        $porteros = $result->AllGoalKeepersResult;

        echo '<h1>Porteros</h1>';
        foreach ($porteros->string as $key => $value) {
            echo $value . '<br>';
        }
        
        //--------------------------------------------------------------------------------------------------------------
        $result = $client->AllDefenders(array('sCountryName' => false));
        $defensas = $result->AllDefendersResult;

        echo '<h1>Defensas</h1>';
        foreach ($defensas->string as $key => $value) {
            echo $value . '<br>';
        }

        //--------------------------------------------------------------------------------------------------------------
        $result = $client->AllMidFields(array('sCountryName' => false));
        $medioscentros = $result->AllMidFieldsResult;

        echo '<h1>Medios centros</h1>';
        foreach ($medioscentros->string as $key => $value) {
            echo $value . '<br>';
        }
        
        //--------------------------------------------------------------------------------------------------------------
        $result = $client->AllForwards(array('sCountryName' => false));
        $delanteros = $result->AllForwardsResult;
        
        echo '<h1>Delanteros</h1>';
        foreach ($delanteros->string as $key => $value) {
            echo $value . '<br>';
        }


//        echo '<pre>';
//        print_r($porteros);
//        echo '</pre>';
    }

}
