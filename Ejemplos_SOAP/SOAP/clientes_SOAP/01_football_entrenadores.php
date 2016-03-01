<?php
/**
 * Simple PHP SOAP example
 * @link http://www.vankouteren.eu/blog/2009/03/simple-php-soap-example/
 * 
 * WSDL http://footballpool.dataaccess.eu/data/info.wso?wsdl
 * 
 * LISTA DE ENTRENADORES del Mundial de Sudafrica 2010
 * 
 * Con la herramienta SOAPUI (http://sourceforge.net/projects/soapui/) podemos examinar los metodos disponibles
 * y realizar llamadas de prueba para ver que nos está devolviendo el serivicio
 * 
 * Si se examina el fichero WSDL con el WSDL Editor (Eclise Keppler JEE) podrá ver y analizar el 
 */


  $client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?wsdl");

  
  $result = $client->Coaches();

  // Note that $array contains the result of the traversed object structure
  $entrenadores = $result->CoachesResult->tCoaches;
  
  /*
   * El resultado devuelto segun el fichero WSDL será una lista (coleccion / array) de entrenadores 
   * "tCoaches" que contiene un objeto con información sobre el entrenador con los siguientes atributos
   *  	sName: Nombre del entrenador
   *  	TeamInfo: Información sobre el equipo, que será a su ven un objeto con los atributos
   *  		iId
   *  		sName
   *  		sCountriFlag: URL imagen
   *  		sWikipediaURL
   *  		sCountryFlagLarge: URL imagen
   */

?>
  
  
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mundial Sudafrica 2010</title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>

<body>  
  <h1>Entrenadores Mundial Sudafrica 2010</h1>
  <table border="1">
      <tr>
        <th>Bandera</th>
        <th>Pais</th>
        <th>Entrenador</th>
      </tr>
  <?php  foreach($entrenadores as $info) : ?>
      <tr>
        <td><img src="<?=$info->TeamInfo->sCountryFlag?>"/></td>
          <td><?=$info->TeamInfo->sName?></td>
          <td><?=$info->sName?></td>
        </tr>
  <?php endforeach; ?>
  </table>
  
<?php  
	echo "<h1>Funciones Disponibles</h1>";
	echo "<pre>".print_r($client->__getFunctions(),true)."</pre>";
	
	
	echo "<h1>Tipos Disponibles</h1>";
	echo "<pre>".print_r($client->__getTypes(),true)."</pre>";  
?>  
</body>
</html>