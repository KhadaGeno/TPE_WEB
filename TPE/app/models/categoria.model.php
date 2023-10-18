<?php
require_once 'config.php'; 

 class categoriaModel{
    private $db;
function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2;charset=utf8', 'root', '');
}
function getcategoria(){
        $query = $this->db->prepare('SELECT * FROM generos');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
        }
    
function updateCategory($UpCat){
    $query = $this->db->prepare('UPDATE generos SET nombre_gen = '$UpCat' WHERE 1');
        $query->execute();
        $Update = $query->fetchAll(PDO::FETCH_OBJ);

        return $Update;
        }
    }
?>