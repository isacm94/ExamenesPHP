<?php
/*
	Elementos que se muestan en la plantilla
	- $tmpl_titulo: (opcional) título de la página 
	- $tmpl_head:  (opcional)  Incluimos cualquier tipo de información que deseemos en la sección <head> 
	- $tmpl_menu: (opcional) Enlaces del menú
	- $tmpl_cuerpo: (obligatorio) Cuerpo de la página
	- $tmpl_script: (opcional) Código script en javascript. No precisa etiqueta <script>
*/
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Plantilla Ejercicio 1</title>
  <style type="text/css">
  	body {font-family:Verdana, Geneva, sans-serif }
	#menu { float:left; width:15em; border:1px solid #888; background:#eee; margin:.5em; font-size:.7em }
	#menu a { display:block; text-decoration:none }
	#menu a:hover { display:block; background:#AEDBFF }
	#cuerpo { border:1px solid #ddd; border-radius:5px; padding:.5em; margin:.5em; color:blue }
	h1 { background:#222; color:#4F3; }
  </style>

	<?php
    // Incluimos cualquier tipo de información que deseemos en la sección <head> 
    if (isset($tmpl_head))
    {
    	echo $tmpl_head; 
    }
    ?> 
  </head>
  <body>
    <h1>PLANTILLA EJERCICIO 1</h1>
    <?php    // Incluimos los enlaces que deseemos en el menú 
    if (isset($tmpl_menu)): ?>
	    <div id="menu"><?=$tmpl_menu?></div>
    <?php endif; ?>
    <div id="cuerpo">
    <?php
    // Cuerpo de la página 
    if (isset($tmpl_cuerpo)) :
    	echo $tmpl_cuerpo; 
	else : ?>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	<?php endif; ?>
    </div>
    <?php
    // Scripts que necesitemos incorporar al final de la plantilla. Tan solo hay que suministrar el código, la etiqueta <script> se añade 
    if (isset($tmpl_script))
    { 
    	echo "\n<script>\n$tmpl_script\n</script>";
    }
    ?> 
    </body>
</html>