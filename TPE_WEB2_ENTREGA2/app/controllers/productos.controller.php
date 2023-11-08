<?php

require_once "app/models/productos.model.php";
require_once "app/views/productos.view.php";

class ProductosController {

    private $view;
    private $model;
    
    function __construct () {
        $this->view = new ProductosView();
        $this->model = new ProductosModel();
    }

    function showProductos () {
        $productos = $this->model->getProductos();
        $this->view->showProductos($productos);
    }

    function showProductoUnico ($id) {
        $producto = $this->model->getProductoUnico($id);
        $this->view->showProducto($producto);
    }

    function showProductosCategoria ($id) {
        $productos = $this->model->getProductoCategoria($id);
        $this->view->showProductos($productos);
    }
}