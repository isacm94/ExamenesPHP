
<html>
    <head>
        <title>Países</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            table {
                width: 250px;
                border: 1px solid #000;
                border-collapse: collapse;
                width: 60%;
            }
            th, td {
                border: 1px solid #000;

            }
            span {
                margin: 5px;
                
            }
        </style>
    </head>
    <body>
        <h3>Mostrar filtrando: <a href="<?=  site_url().'/Ctrl_index'?>">Todos</a><?=$enlaces?></h3>
    <center>
        <h2>LISTA DE PAÍSES</h2>
        <h4>Número de países: <?=$numpaises?></h4>
        <table>
            <tr>
                <th>Nombre País</th>
                <th>Continente</th>
            </tr>
            <?php foreach ($paises as $key => $value): ?>
                <tr>
                    <td><?= $value['nombre'] ?></td>
                    <td><?= $value['continente'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?=$this->pagination->create_links(); ?>
    </center>
</body>
</html>


