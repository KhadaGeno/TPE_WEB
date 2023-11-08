<?php

class ProductosModel {

    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2_entrega2;charset=utf8', 'root', '');
    }

    function getProductos () {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductoUnico ($id) {
        $query = $this->db->prepare('SELECT nombre, descripcion, precio FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }

    function getProductoCategoria ($id) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_genero = ?');
        $query->execute([$id]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);
        return $productos;
    }
}