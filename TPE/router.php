<?php
require_once './app/controllers/categoria.controller.php';
require_once './app/controllers/games.controller.php';
require_once './app/controllers/about.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new categoriaController();
        $controller->showcategory();
        break;
    case 'games':
        $controller = new GamesController();
        $controller->showgames();
        break;
    case 'content':
        $controller = new GamesController();
        $controller->showContentGame($params[1]);
        break;
    case 'filtrocategoria':
        $controller = new GamesController();
        $controller->showfiltercategory($params[1]);
        break;
    case 'editarcategoria':
        $controller = new GamesController();
        $controller->showfiltercategory($params[1]);
        break;         
    case 'about':
        $controller = new AboutController();
        $controller->showAbout();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
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
        echo "404 Page Not Found";
        break;
}