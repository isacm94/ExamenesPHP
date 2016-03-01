<?php
try
{
	$server_url=GetCurrentURLFolder().'../srv/servidor.php';
	$wsdl_url=$server_url.'?WSDL';
	
	echo "<p>WSDL URL: $wsdl_url</p>";
	
	
	//$clienteSOAP = new SoapClient($wsdl_url);
	$clienteSOAP = new SoapClient($wsdl_url, array(
			//'location'=>$server_url,
			//'uri'=>$server_url,
			'cache_wsdl'=>WSDL_CACHE_NONE, 			// Evitamos que guarde en cache el fichero WSDL. Esto es util en producci�n pues en otro caso modificaciones en dicho fichero no se tendr�n en cuenta
			'trace'=>1,								// Activamos el modo traza
		)
	);

	
	echo "<h2>Info - Funciones disponibles</h2><pre>".print_r($clienteSOAP->__getFunctions(), true)."</pre>";
	
	
	$sumaResponse = $clienteSOAP->Suma(array('n1'=>2, 'n2'=>3));

	$devuelto = $clienteSOAP->__call('Suma', array('n1'=>2, 'n2'=>3));
	 
	echo "la suma de 2 mas 3 es: " . $devuelto->resultado . "<br/>";
 
} 
catch(SoapFault $e)
{
	echo "<h1>Error</h1><pre>".print_r($e, true)."</pre>";
 	echo "<h2>Info - Last Request</h2><pre>".$clienteSOAP->__getLastRequest()."</pre>";
 	
 	echo "<h2>Info - Last Response</h2><pre>".$clienteSOAP->__getLastResponse()."</pre>";
 	echo "<h2>Info - Funciones</h2><pre>".print_r($clienteSOAP->__getFunctions(),true)."</pre>";
 	
}


/**
 * Devuelva la URL desde la petición en curso
 * @return string
 */
function getCurrentUrl(){

	$domain = $_SERVER['HTTP_HOST'];

	$url = "http://" . $domain . $_SERVER['REQUEST_URI'];

	return $url;
}

/**
 * Devuelva la URL que contiene la carpeta del archivo, suponiendo
 * que se esté invocando directamente al este archivo
 */
function GetCurrentURLFolder()
{
	$file=basename(__FILE__);
	$url=getCurrentUrl();
	return substr($url, 0, -strlen($file));
}