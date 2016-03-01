<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $contentXML = utf8_encode(file_get_contents('././cursos.xml'));
        //$xml = simplexml_load_string($contentXML);las dos formas funcionan        
        $xml = new SimpleXMLElement($contentXML);


        foreach ($xml->xpath('//curso') as $curso) {
            if ((string) $curso->category == '7')
                echo utf8_decode((string) $curso->fullname) . '<br>';
        }        // put your code here
        ?>
    </body>
</html>
