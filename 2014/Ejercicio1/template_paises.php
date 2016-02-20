<?php
	/*Elementos que se muestan en la plantilla
	- $tmpl_titulo: (opcional) t�tulo de la p�gina 
	- $tmpl_head:  (opcional)  Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head> 
	- $tmpl_menu: (opcional) Enlaces del men�
	- $tmpl_cuerpo: (obligatorio) Cuerpo de la p�gina
	- $tmpl_script: (opcional) C�digo script en javascript. No precisa etiqueta <script>*/
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Lista de Paises</title>
  <style type="text/css">
  	body {font-family:Verdana, Geneva, sans-serif }
	#menu { float:left; width:15em; border:1px solid #888; background:#eee; margin:.5em; font-size:.7em }
	#menu a { display:block; text-decoration:none }
	#menu a:hover { display:block; background:#AEDBFF }
  </style>

	<?php	
    // Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head> 
    if (isset($tmpl_head))
    {
    	echo $tmpl_head; 
    }
    ?> 
  </head>
  <body>
    <h1>PAISES</h1>
    <?php    // Incluimos los enlaces que deseemos en el men� 
    if (isset($tmpl_menu)): ?>
	    <div id="menu"><?=$tmpl_menu?></div>
    <?php endif; ?>
    <div id="cuerpo">
    <?php
    // Cuerpo de la p�gina 
    if (isset($tmpl_cuerpo))
    {
    	echo $tmpl_cuerpo; 
    }
	else
	{
		echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
	}
    ?>     	
    </div>
 
    <?php
    // Scripts que necesitemos incorporar al final de la plantilla. Tan solo hay que suministrar el c�digo, la etiqueta <script> se a�ade 
    if (isset($tmpl_script))
    { 
    	echo "\n<script>\n$tmpl_script\n</script>";
    }
    ?> 
    </body>
</html>