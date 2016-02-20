<?php
/* Elementos que se muestan en la plantilla
  - $tmpl_titulo: (opcional) t�tulo de la p�gina
  - $tmpl_head:  (opcional)  Incluimos cualquier tipo de informaci�n que deseemos en la secci�n <head>
  - $tmpl_menu: (opcional) Enlaces del men�
  - $tmpl_cuerpo: (obligatorio) Cuerpo de la p�gina
  - $tmpl_script: (opcional) C�digo script en javascript. No precisa etiqueta <script> */
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
            .normal {
                width: 80%;
                border: 1px solid #000;
                border-collapse: collapse;
            }
            .normal th, .normal td {
                border: 1px solid #000;
            }
        </style>

        <?php
        // Incluimos cualquier tipo de información que deseemos en la secci�n <head> 
        if (isset($tmpl_head)) {
            echo $tmpl_head;
        }
        ?> 
    </head>
    <body>
        <h1>PAISES</h1>
        <?php
        // Incluimos los enlaces que deseemos en el menú 
        if (isset($tmpl_menu)):
            ?>
            <div id="menu">
                <a href="<?= base_url()?>">Todos</a>
                <?php foreach ($tmpl_menu as $idx): ?>
                    <?php foreach ($idx as $value): ?>
                        <a href="<?= site_url() . '/Ctrl_index/MostrarContinente/' . $value ?>"><?= $value ?></a>
                    <?php endforeach; ?>   
                <?php endforeach; ?>   
            </div>

        <?php endif; ?>
        <div id="cuerpo">
            <?php
            // Cuerpo de la p�gina 
            if (isset($tmpl_cuerpo)) {?>
            <?php if(isset($continente)):?>
            <h1>LISTA DE PAÍSES(Todos/<?=$continente;?>...)</h1>
            <h3>Números de países: <?php if(isset($numpaises)) echo $numpaises; ?></h3>
                
                <table class="normal" summary="Tabla genérica">
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Continente</th>
                        <th scope="col">Operación</th>
                    </tr>
                    
                    
                        <?php foreach ($tmpl_cuerpo as $key => $value): ?>
                    <tr>
                        <td><?= $value['nombre'] ?></td>
                        <td><?= $value['continente'] ?></td>
                        <td><a href="<?=  site_url().'/Ctrl_index/Editar/'.$value['id']?>">Editar</a></td>
                    </tr>

                    <?php  endforeach; endif; ?>

                </table>

            <?php
               if(isset($cuerpo))
                   echo $cuerpo;
               
                echo $this->pagination->create_links(); 
                
                
        
            }
            if(isset($cuerpo))
                   echo $cuerpo;
            ?>     
            
        </div>

        <?php
        
        
        // Scripts que necesitemos incorporar al final de la plantilla. Tan solo hay que suministrar el c�digo, la etiqueta <script> se a�ade 
        if (isset($tmpl_script)) {
            echo "\n<script>\n$tmpl_script\n</script>";
        }
        ?> 
    </body>
</html>