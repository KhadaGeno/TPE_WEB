<?php

require_once "app/models/categoria.model.php";
require_once "app/models/productos.model.php";
require_once "app/views/productos.view.php";

class ProductosController {

    private $view;
    private $model;
    private $categoriaModel;
    
    function __construct () {
        $this->view = new ProductosView();
        $this->model = new ProductosModel();
        $this->categoriaModel = new CategoriaModel();
    }

    function showProductos () {
        $productos = $this->model->getProductos();
        $this->view->showProductos($productos);
    }

    function showProductoUnico ($id) {
        $producto = $this->model->getProductoUnico($id);
        $categoria = $this->categoriaModel->getCategoriaUnica($producto->id_genero);
        $this->view->showProducto($producto, $categoria);
    }

    function showProductosCategoria ($id) {
        $productos = $this->model->getProductoCategoria($id);
        $this->view->showProductos($productos);
    }
}