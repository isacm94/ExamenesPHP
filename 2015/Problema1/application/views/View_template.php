<?php
/*
  Elementos que se muestan en la plantilla
  - $tmpl_titulo: (opcional) t�tulo de la p�gina
  - $tmpl_head:  (opcional)  Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head>
  - $tmpl_menu: (opcional) Enlaces del men�
  - $tmpl_cuerpo: (obligatorio) Cuerpo de la p�gina
  - $tmpl_script: (opcional) C�digo script en javascript. No precisa etiqueta <script>
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
        // Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head> 
        if (isset($tmpl_head)) {
            echo $tmpl_head;
        }
        ?> 
    </head>
    <body>
        <h1>PLANTILLA EJERCICIO 1</h1>
        <?php
        // Incluimos los enlaces que deseemos en el men� 
        if (isset($tmpl_menu)):
            ?>
            <div id="menu"><?= $tmpl_menu ?></div>
        <?php endif; ?>
        <div id="cuerpo">
            <?php if(isset($tmpl_cuerpo))
                  echo $tmpl_cuerpo?>
        </div>
        <?php
        // Scripts que necesitemos incorporar al final de la plantilla. Tan solo hay que suministrar el c�digo, la etiqueta <script> se a�ade 
        if (isset($tmpl_script)) {
            echo "\n<script>\n$tmpl_script\n</script>";
        }
        ?> 
    </body>
</html>