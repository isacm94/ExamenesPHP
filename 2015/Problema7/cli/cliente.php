<?php

try {
    $server_url = GetCurrentURLFolder() . '../srv/servidor.php';

    echo "<p>Servidor sin WSDL</p>";

    //
    // Abrimos el cliente en modo NO WSDL
    //
	$clienteSOAP = new SoapClient(null, array(
        'location' => $server_url,
        'uri' => $server_url,
        //'cache_wsdl'=>WSDL_CACHE_NONE, 			// Evitamos que guarde en cache el fichero WSDL. Esto es util en producci�n pues en otro caso modificaciones en dicho fichero no se tendr�n en cuenta
        'trace' => 1, // Activamos el modo traza
            )
    );

    //
    // Sin WSDL no tengo información sobre las funciones disponibles
    //
    //echo "<h2>Info - Funciones disponibles</h2><pre>" . print_r($clienteSOAP->__getFunctions(), true) . "</pre>";
    
    ?>
<form method="POST">
    <p>
        Número de apuestas: <input type="text" name="num">
       <input type="submit" value="Generar" name="generar">
    </p>
</form>
    <?php
    if($_POST){
        $apuestas = $clienteSOAP->__call('GeneraApuestas', array('num_apuestas' => $_POST['num']));
                
//        echo '<pre>';
//        print_r($apuestas);
//        echo '</pre>';
        echo '<h1>APUESTAS GENERADAS</h1>';
        foreach ($apuestas as $key => $value) {
            echo "Apuesta ".($key+1);
            echo ": $value<br>";
        }
    }
    
} catch (SoapFault $e) {
    echo "<h1>Error</h1><pre>" . print_r($e, true) . "</pre>";
    echo "<h2>Info - Last Request</h2><pre>" . $clienteSOAP->__getLastRequest() . "</pre>";

    echo "<h2>Info - Last Response</h2><pre>" . $clienteSOAP->__getLastResponse() . "</pre>";
    echo "<h2>Info - Funciones</h2><pre>" . print_r($clienteSOAP->__getFunctions(), true) . "</pre>";
}

/**
 * Devuelva la URL desde la petición en curso
 * @return string
 */
function getCurrentUrl() {

    $domain = $_SERVER['HTTP_HOST'];

    $url = "http://" . $domain . $_SERVER['REQUEST_URI'];

    return $url;
}

/**
 * Devuelva la URL que contiene la carpeta del archivo, suponiendo
 * que se esté invocando directamente al este archivo
 */
function GetCurrentURLFolder() {
    $file = basename(__FILE__);
    $url = getCurrentUrl();
    return substr($url, 0, -strlen($file));
}
