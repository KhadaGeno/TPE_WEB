<?php

class UsuarioModel {

    private $db;

    function __construct () {
        $this->db = new PDO('mysql:host=localhost;dbname=tpe_web2_entrega2;charset=utf8', 'root', '');
    }

    function getUsuario ($usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$usuario]);
        $usuarioEncontrado = $query->fetch(PDO::FETCH_OBJ);
        return $usuarioEncontrado;
    }
}