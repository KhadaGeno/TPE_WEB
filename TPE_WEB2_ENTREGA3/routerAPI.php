<?php
    require_once './app/api/libs/router.php';
    require_once './app/api/controllers/api.productos.controller.php';

$router = new Router();

$router->addRoute('productos','GET','ProductosAPIController','getProductos');
$router->addRoute('productos/:ID','GET','ProductosAPIController','getProductosID');
$router->addRoute('addProducto','GET','ProductosAPIController','addProducto');

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);