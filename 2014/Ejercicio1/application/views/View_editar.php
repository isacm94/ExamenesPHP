<h2>EDITANDO PAÍS</h2>
<h3>Editando datos de</h3>

<form method="post" action="<?php echo site_url().'/Ctrl_index/Editar/'.$id;?>">
    <p>
        <label>Nombre del país: </label>
        <input type="text" name="pais">
        <?= form_error('pais'); ?>
    </p>
    
    <p>
        <label>Cod. ISO 2 letras: </label>
        <input type="text" name="iso2">
        <?= form_error('iso2'); ?>
    </p>
    
    <p>
        <label>Cod. ISO 3 letras: </label>
        <input type="text" name="iso3">
        <?= form_error('iso3'); ?>
    </p>
    
    <p>
        <label>Continente: </label>
        <input type="text" name="continente">
        <?= form_error('continente'); ?>
    </p>
    
    <input type="submit" name="guardar" value="Guardar">
    <input type="button" name="cancelar" value="Cancelar">
</form>
