<?php

/**
 * Ejemplo de servidor SOAP utilizando la librería de PHP
 * 
 * El servidor trabaja en modo NO WSDL, por lo que no será preciso definir el fichero WSDL
 * 
 */

/**
 * NUESTRO SERVIDOR SOAP
 */

if(!extension_loaded("soap")){
	dl("php_soap.dll");
}

	ini_set("soap.wsdl_cache_enabled","0");

	// Creamos un nuevo servicio SOAP que sirve en la misma dirección que nos han solicitado
	$server = new SoapServer(
								null,							// Indica que trabajamos en modo NO WSDL
								array(
									'uri' => getCurrentUrl(), 	// Ubicación del servidor. Obligatorio en modo NO WSDL
								)
	);


/* ***************************************************************************************
 *  REGISTRO DE FUNCIONES Y PROCESADO DE PETICIONES
 * 
 ****************************************************************************************/

	/*
	 * Registro de funciones que implementa el servidor
	 */
	$server->AddFunction("suma");
	
	$server->AddFunction("Cuadrado");
	
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// Solamente hay petición si se hace una petición POST
			
		// Procesamos peticiones
		$server->handle();
	}
	else 
	{	
		//
		// Código para depuración -- Información de ayuda	
		//
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


/**
 * Devuelve el cuadrado de un número
 * @param double $n
 * @return number
 */
function Cuadrado($n)
{
	return  $n*$n;
}

/* ***************************************************************************************
 *  FUNCIONES AUXILIARES
 ****************************************************************************************/

/**
 * Devuelva la URL desde la petición en curso
 * @return string
 */
function getCurrentUrl(){

	$domain = $_SERVER['HTTP_HOST'];

	$url = "http://" . $domain . $_SERVER['REQUEST_URI'];

	return $url;
}
