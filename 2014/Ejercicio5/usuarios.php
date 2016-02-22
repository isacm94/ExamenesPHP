<?php

Interface ReceptorDeCorreo {

    function Nombre();

    function Direccion();
}

/* No se puede quitar o modificar nada de la clase. Solo añadir 
  Si se modifica o elimina algo la puntuación será menor según se
  indica en el apartado de puntuación
 */

class Usuario implements ReceptorDeCorreo {

    // No se puede modificar la visibilidad de los atributos
    private $nombre;
    private $email;

    public function __construct($nombre, $email) {
        $this->nombre = $nombre;
        $this->email = $email;
    }

    public function Direccion() {
        return $this->email;
    }

    public function Nombre() {
        return $this->nombre;
    }

    //
    // Se debe ampliar la clase para lograr solucionar el problema
//
}

//////////////////////////////////
$listaReceptoresDeCorreo = array(
    new Usuario('Jose', 'isacm94@gmail.com'),
    new Usuario('Pepe1', 'isacm94@hotmail.com'),
    new Usuario('Pepe2', 'sdz2@ono.com'),
    new Usuario('Pepe3', 'sdz2@ono.com'),
);
