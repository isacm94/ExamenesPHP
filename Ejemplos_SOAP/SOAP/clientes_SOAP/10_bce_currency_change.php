<?php
/**
 * @link http://www.ecb.europa.eu/stats/exchange/eurofxref/html/index.en.html
 * 
 * Este no es un servicio SOAP, se incluye para que se vea como se puede recibir
 * información de la web y analizarla
 * 
 * En este caso lo que hacemos es procesar un fichero XML devuelto desde la web
 * que tiene el formato indicado en la url 
 * http://www.ecb.europa.eu/stats/exchange/eurofxref/html/index.en.html
 * y mostrar su información.
 * 
 * El proceso de trabajo, en el caso de utilizarlo sería el siguiente
 * - Se lee la información y se almacena en nuestra base de datos, o se cachea en
 *   un fichero local, solamente una vez al día
 * - Se recupera la información del fichero local y se procesa como proceda
 * 
 */

//This is aPHP(5)script example on how eurofxref-daily.xml can be parsed
//Read eurofxref-daily.xml file in memory
//For the next command you will need the config option allow_url_fopen=On (default)
$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
//the file is updated daily between 2.15 p.m. and 3.00 p.m. CET

/** NOTA
 *  Las funciones de PHP file(), file_get_contents() ... permiten abrir recursos web y obtenerlos
 *  para procesarlos de forma sencilla
 */

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Valor del euro a <?=date('d/m/y')?></title>
<style type="text/css">
body {
	font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>

<body>  
  <h1>Valor del euro <?=date('d/m/y')?></h1>
  <table>
  <?php foreach($XML->Cube->Cube->Cube as $rate) : 
	//Output the value of 1EUR for a currency code
  ?>
    <tr>
		<td>1&euro;=</td>
		<td><?=$rate["rate"]?></td>
		<td><?=$rate["currency"]?></td>
	</tr>
  <?php endforeach; ?>
  </table>
</body>
</html>
