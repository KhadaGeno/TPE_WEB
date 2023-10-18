<?php
require_once './app/models/categoria.model.php';
require_once './app/views/categoria.view.php';

class categoriaController{

    private $model;
    private $view;

    public function __construct() {
        $this->model = new categoriaModel();
        $this->view = new categoriaView();
    }
public function showcategory(){
    $category= $this->model->getcategoria();
    $this->view->showcategory($category);
    }
}