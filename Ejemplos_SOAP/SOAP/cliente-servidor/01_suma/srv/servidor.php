<?php

/**
 * Basado en el artículo "Cómo implementar Web Services WSDL SOAP en PHP", en el que se ha
 * definido un nuevo fichero WSDL utilizando Eclipse-JEE-IDE 
 * 
 * @link http://blog.openalfa.com/como-implementar-web-services-wsdl-soap-en-php/
 * 
 * Véase http://wiki.eclipse.org/Introduction_to_the_WSDL_Editor  para tener instrucciones sobre 
 * como crear el fichero WSDL
 * 
 *  Pasos para la creación del servidor
 *  - Crear el fichero WSDL que describa los servicios, con WSDL editor
 *  - Registrar las funciones que implementan los servicios
 *  - Procesar las peticiones
 * 
 * 
 * NOTA
 * 	Cuando crearmos el fichero WDSL debemos indicar el namespace, que será la URL que contiene
 *  el servidor. Si no se ha definido correctamente al crearlo se debería editar el fichero WSDL
 *  para que contenga la URL de esta fichero
 * 
 */

$wsdl_file="suma_srv.wsdl";

/**
 * Lo siguiente permitirá obtener el fichero WSDL del servicio soap con la siguiente consulta
 * http://url_servidor.php?WSDL
 */
if (isset($_GET['WSDL']))
{
	header ("Content-Type:text/xml");
	$wsdl=file_get_contents($wsdl_file);
	echo $wsdl;
	exit;
}

/**
 * NUESTRO SERVIDOR SOAP
 */

if(!extension_loaded("soap")){
	dl("php_soap.dll");
}

	ini_set("soap.wsdl_cache_enabled","0");

	// Creamos el objeto y procesamos WSDL
	//
	// Nota, para que os funcione en vuestro equipo deberéis modificar el fichero WSDL para que 
	// contenga la ruta de este fichero
	$server = new SoapServer($wsdl_file);


/* ***************************************************************************************
 *  REGISTRO DE FUNCIONES Y PROCESADO DE PETICIONES
 * 
 ****************************************************************************************/

	/*
	 * Registro de funciones que implementa el servidor
	 */
	$server->AddFunction("suma");
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// Solamente hay petición si se hace una petición POST
			
		// Procesamos peticiones
		$server->handle();
	}
	else 
	{	// Código para depuración
		echo "<h1>Servidor SOAP</h1><p>Este servidor SOAP puede manejar las siguientes funciones: </p>";
		$functions = $server->getFunctions();
		echo "\n<ul>\n";
		foreach($functions as $func) {
			echo "<li>".$func . "</li>\n";
		}
		echo "</ul>\n";
	}	
	

	
/* ***************************************************************************************
 *  DEFINICIÓN DE FUNCIONES DEL SERVIDOR
 *  Podrían estar en otro fichero
 ****************************************************************************************/

/**
 * Funcion que realiza una suma de dos números
 * @param int $n1
 * @param int $n2
 * @return number
 */
function suma($n1,$n2)
{
	return $n1+$n2;
}
