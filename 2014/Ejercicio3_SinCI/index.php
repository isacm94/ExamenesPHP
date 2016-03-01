<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
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
            echo $value->sName . ' - ' . $value->iYellowCards . '<br>';
        }

        //        echo '<pre>';
//        print_r($jugadores);
//        echo '</pre>';
        ?>
    </body>
</html>
