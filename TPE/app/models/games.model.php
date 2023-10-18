<?php
require_once 'config.php'; 
class gamesModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2;charset=utf8', 'root', '');
    }


    function getgames() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $games = $query->fetchAll(PDO::FETCH_OBJ);
        return $games;
    }

    function filtroCategoria($id_genero){
        $query = $this->db->prepare('SELECT id_genero, nombre, precio FROM productos where id_genero=?');
        $query->execute([$id_genero]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    function GetContent($id){
    $query = $this->db->prepare('SELECT nombre, Descripcion, precio FROM productos WHERE id_genero=?');
    $query->execute([$id]);
    return $query->fetchAll(PDO::FETCH_OBJ);
    }
    

    /**
     * Inserta la tarea en la base de datos
     */
    function BuyGame($name, $genre, $price){
        $query = $this->db->prepare('INSERT INTO Compras (nombre, precio, genero) VALUES(?,?,?)');
        $query->execute([$name, $genre, $price]);

        return $this->db->lastInsertId();
    }

    
function deleteTask($id) {
    $query = $this->db->prepare('DELETE FROM tareas WHERE id = ?');
    $query->execute([$id]);
}

function updateTask($id) {    
    $query = $this->db->prepare('UPDATE tareas SET finalizada = 1 WHERE id = ?');
    $query->execute([$id]);
}
}