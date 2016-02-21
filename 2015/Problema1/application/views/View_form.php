<form method="POST" action="">
    <p>
        <label>Matrícula: </label> 
        <input type="text" name="matricula" value="<?= set_value('matricula')?>">
        <?= form_error('matricula'); ?>
    </p>

    <p>
        <label>Tipo de coche: </label> 
        <select name="tipo">
            <option value="defecto" <?= set_select('tipo', 'defecto', TRUE) ?>>Seleccione uno</option>
            <option value="Coche" <?= set_select('tipo', 'Coche') ?>>Coche</option>
            <option value="Furgoneta" <?= set_select('tipo', 'Furgoneta') ?>>Furgoneta</option>
            <option value="Camion" <?= set_select('tipo', 'Camion') ?>>Camión</option>
        </select>
        <?= form_error('tipo'); ?>
        
    </p>

    <p>
        <label>Nº de pasajeros: </label>
        <input type="number" name="numpasajeros" value="<?= set_value('numpasajeros', 0)?>">
        <?= form_error('numpasajeros'); ?>
    </p>
    <input type="submit" name="procesar" value="Procesar">
</form>