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
        $contentXML = utf8_encode(file_get_contents('././huelvabuenasnoticias.xml'));
        //$xml = simplexml_load_string($contentXML);las dos formas funcionan        
        $xml = new SimpleXMLElement($contentXML);

        echo utf8_decode('<h3>' . $xml->channel->title . '</h3>');
        foreach ($xml->xpath('//item') as $item) {
            echo utf8_decode((string) $item->title) . '<br>';
        } // put your code here
        ?>
    </body>
</html>
