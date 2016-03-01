<?php
/*
 * @link http://www.service-repository.com/service/overview/1132083200
 * 
 * Véase la pestaña interface para ver los métodos que tenemos disponibles
 * 
 * WSDL: http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL 
 * 
 * Analicense los métodos con SoapUI
 * 
 * NOTAS SOBRE EL CLIENTE SOAP DE PHP
 * 
 * - El cliente analiza el fichero WSDL y crea una función para cada uno de los métodos que proporciona el servicio
 *   descritos en el fichero
 *   
 * - Los elementos de XML (tipos) que contienen atributos internos se transforman en objetos con sus atribututos
 * - Las colecciones se transforman en arrays
 * 
 */
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Servicio SOAP - Clima</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>

<body>  
  <h1>Clima en ciudades EEUU</h1>

<?php 

try {
	$client = new SoapClient(
			"http://wsf.cdyne.com/WeatherWS/Weather.asmx?WSDL",	// URL del fichero WSDL
			/* Opciones */ 
			array(
				'cache_wsdl'=>WSDL_CACHE_NONE, 			// Evitamos que guarde en cache el fichero WSDL. Esto es util en producci�n pues en otro caso modificaciones en dicho fichero no se tendr�n en cuenta
				'trace'=>1,								// Activamos el modo traza
			)
	);
	
	echo "<h1>Climatología</h1>";
	// Buscamos tiempo para ciudades 
	// En http://www.zip-area.com/ podemos obtener los c�digos postales de EEUU
	// Seatle - 98101
	$result = $client->GetCityWeatherByZIP(array('ZIP' => '98101'));
	
	// El resultado es un objeto seg�n nos indica la descripci�n WSDL
	MuestraInfoCiudad($result->GetCityWeatherByZIPResult);
	
	// Los Angeles - 90001
	$result = $client->GetCityWeatherByZIP(array('ZIP' => '90001'));
	MuestraInfoCiudad($result->GetCityWeatherByZIPResult);

	// Nueva York - 10001
	$result = $client->GetCityWeatherByZIP(array('ZIP' => '10001'));
	MuestraInfoCiudad($result->GetCityWeatherByZIPResult);
	
	echo "<h1>Funciones Disponibles</h1>";
	echo "<pre>".print_r($client->__getFunctions(),true)."</pre>";
	
	
	echo "<h1>Tipos Disponibles</h1>";
	echo "<pre>".print_r($client->__getTypes(),true)."</pre>";
	
}
// Si hay error se lanza excepcion
catch (SoapFault $e) {
	echo '<h1>Error - Excepci�n</h1><pre>'.print_r($e, true).'</pre>';
	echo '<p>LastRequest</p><pre>'.$client->__getLastRequest().'</pre>';
	echo '<p>LastResponse</p><pre>'.$client->__getLastResponse().'</pre>';
	
}
?>

</body>
</html>

<?php 
function MuestraInfoCiudad($info)
{
?>
    <h2><?=$info->City?></h2>
	<table border="1">
	<tr>
		<td>Ciudad estación meteorologíca</td>
		<td><?=$info->WeatherStationCity?></td>
	</tr>
	<tr>
		<td>Climatología</td>
		<td><?=$info->Description?></td>
	</tr>
	<tr>
		<td>Humedad relativa</td>
		<td><?=$info->RelativeHumidity?></td>
	</tr>
	</table>
<?php 
}	// Fin de funci�n
?>