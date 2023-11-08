<?php
class AuthHelper {

    public static function init() {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
    
    public static function login($usuario) {
        AuthHelper::init();
        $_SESSION['id_usuario'] = $usuario->id;
        $_SESSION['usuario'] = $usuario->usuario;
        $_SESSION['rol'] = $usuario->rol; 
    }

    public static function logout() {
        AuthHelper::init();
        session_destroy();
    }
    public static function checkSession() {
        AuthHelper::init();
        if(!isset($_SESSION['usuario'])){
            header('Location: ' . LOGIN);
            die();
        }
    }

    public static function verify() {
        AuthHelper::init();
        if (isset($_SESSION['usuario'])) {
            if($_SESSION['rol'] == "administrador"){
                return "administrador";
            }
            else if($_SESSION['rol'] == "user"){
                return "user";
            }
        }
    }
}