<?php
require_once "./app/controllers/productos.controller.php";
require_once "./app/controllers/categoria.controller.php";
require_once "./app/controllers/auth.controller.php";
require_once "./app/controllers/amb.controller.php";
require_once "./app/controllers/error.controller.php";

define('HOME', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
define('LOGIN', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/login');
define('JUEGOS', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/juegos');

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
    case 'agregar':
        $controller = new AMBController();
        $controller->showAgregar();
        break;
    case 'showAddProducto':
        $controller = new AMBController();
        $controller->showAddProducto();
        break;
    case 'addProducto':
        $controller = new AMBController();
        $controller->addProducto();
        break;
    case 'showUpdateProducto':
        $controller = new AMBController();
        $controller->showUpdateProducto($params[1]);
        break;
    case 'updateProducto':
        $controller = new AMBController();
        $controller->updateProducto($params[1]);
        break;
    case 'deleteProducto':
        $controller = new AMBController();
        $controller->deleteProducto($params[1]);
        break;
    case 'showAddCategoria':
        $controller = new AMBController();
        $controller->showAddCategoria();
        break;
    case 'addCategoria':
        $controller = new AMBController();
        $controller->addCategoria();
        break;
    case 'showUpdateCategoria':
        $controller = new AMBController();
        $controller->showUpdateCategoria($params[1]);
        break;
    case 'updateCategoria':
        $controller = new AMBController();
        $controller->updateCategoria();
        break;
    case 'deleteCategoria':
        $controller = new AMBController();
        $controller->deleteCategoria($params[1]);
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