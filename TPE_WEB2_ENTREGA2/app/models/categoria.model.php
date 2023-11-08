<?php

class CategoriaModel {

    private $db;

    function __construct () {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2_entrega2;charset=utf8', 'root', '');
    }
    
    function getCategorias () {
        $query = $this->db->prepare('SELECT * FROM categoria');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
}