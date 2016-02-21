<?php

class Mdl_paises extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getContinentes() {

        $query = $this->db->query("SELECT distinct(continente) FROM paises ORDER BY continente;");

        return $query->result_array();
    }

    public function getPaises($limit, $start) {

        $query = $this->db->query("SELECT nombre, continente, id FROM paises "
                 . "LIMIT $start, $limit; ");        
        
        return $query->result_array();
    }
    
    public function getNumPaises() {

        $query = $this->db->query("SELECT COUNT(*) 'num' FROM paises;");        
        
        return $query->row_array()['num'];
    }
    
    public function getPaisesFromContinente($nomCont, $limit, $start) {

        $query = $this->db->query("SELECT nombre, continente, id FROM paises WHERE continente LIKE '$nomCont' "
                . "LIMIT $start, $limit; ");
        
        return $query->result_array();
    }
    
    public function getNumPaisesFromContinente($nomCont) {

        $query = $this->db->query("SELECT COUNT(*) 'num' FROM paises WHERE continente LIKE '$nomCont';");        
        
        return $query->row_array()['num'];
    }
    
    public function ActualizaPais($data, $id) {

        $this->db->where('id', $id);
        $this->db->update('paises', $data);
        // Produce:
        // UPDATE mi_tabla
        // SET title = '{$titulo}', name = '{$nombre}', date = '{$fecha}'
        // WHERE id = $id
    }
    
    
    
    public function InsertarProvincia($data) {

        $this->db->insert('tbl_provincias', $data);
    }

    public function ActualizarProvincia($data, $cod) {

        $this->db->where('cod', $cod);
        $this->db->update('tbl_provincias', $data);
        // Produce:
        // UPDATE mi_tabla
        // SET title = '{$titulo}', name = '{$nombre}', date = '{$fecha}'
        // WHERE id = $id
    }

    public function BorrarProvincia($cod) {

        $this->db->delete('tbl_provincias', array('cod' => $cod));
        // Produce:
        // DELETE FROM mi_tabla
        // WHERE id = $id
    }

    public function getNumProvincias() {
        return $this->db->count_all('tbl_provincias');
    }

    public function NoNombreRepetido($nom, $cod) {
        
        $query = $this->db->query(
                "SELECT count(*) as num FROM tbl_provincias "
                . "WHERE nombre='$nom' AND cod!='$cod'");
        
        $num=$query->row()->num;
        
        return $num;
    }

}
