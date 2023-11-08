<?php
require_once "./app/controllers/productos.controller.php";
require_once "./app/controllers/categoria.controller.php";
require_once "./app/controllers/auth.controller.php";
require_once "./app/controllers/error.controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
define('LOGIN', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/login');

$action = 'home'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case "home":
        $controller = new CategoriaController();
        $controller->showCategorias();
        break;
    case 'juegos':
        $controller = new ProductosController();
        $controller->showProductos();
        break;
    case 'juegoUnico':
        $controller = new ProductosController();
        $controller->showProductoUnico($params[1]);
        break;
    case 'categoria':
        $controller = new ProductosController();
        $controller->showProductosCategoria($params[1]);
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        $controller = new ErrorController();
        $controller->showError("Page Not Found");
        break;
}