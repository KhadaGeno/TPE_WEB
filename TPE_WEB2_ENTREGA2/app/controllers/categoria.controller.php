<?php

require_once "app/models/categoria.model.php";
require_once "app/views/categoria.view.php";

class CategoriaController {

    private $model;
    private $view;

    function __construct () {
        $this->model = new CategoriaModel;
        $this->view = new CategoriaView;
    }

    function showCategorias () {
        $categorias = $this->model->getCategorias();
        $this->view->showCategorias($categorias);
    }
}