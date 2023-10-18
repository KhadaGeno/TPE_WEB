<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $usuario = $_POST['usuario'];
        $password = $_POST['contrasenia'];
        $usuario = $this->model->getByuser($usuario);
        if (empty($usuario) && empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }
        
        if ($usuario && password_verify($password, $usuario->contraseña)) {
            
            AuthHelper::login($usuario);
            
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }
}