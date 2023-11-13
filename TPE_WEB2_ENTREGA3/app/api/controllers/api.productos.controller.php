<?php
require_once './app/api/views/api.view.php';
require_once './app/api/models/productos.model.php';

class ProductosAPIController {

    private $view;
    private $model;
    private $data;
    
    function __construct () {
        $this->view = new ApiView();
        $this->model = new ProductosModel();
        $this->data = file_get_contents('php://input');
    }
    public function getdata () {
        return json_decode($this->data);
    }
    function getProductos($params = []){
        if(empty($params)){
        $sort = 'precio';
        $order = 'ASC';
            if(isset($_GET['order'])){
                $order = $_GET['order'];
                if($order !='ASC' && $order != 'DESC'){
                    $order = 'ASC';
                }
            }
            if(isset($_GET['sort'])){
                $sort = $_GET['sort'];
                $columnas = array('nombre','descripcion','precio');
                if(!in_array($sort, $columnas)){
                $sort = 'precio';
                }
            }
        $productos = $this->model->getProductos($order, $sort);
        if($productos){
            $this->view->response($productos,200);
        }else{
            $this->view->response("Page not found",404);
        }
    }
    }
    function getProductosID($params = null){
        $idProducto = $params[':ID'];
        $producto = $this->model->getProductosPorId($idProducto);
        if($producto){
            $this->view->response($producto,200);
        }else{
            $this->view->response("Producto no encontrado",400);
        }
    }
    function addProductos($params = null){
        $addProducto = $this->getdata();
        $nombre = $addProducto->nombre;
        $descripcion = $addProducto->descripcion;
        $precio = $addProducto->precio;
        $id_genero = $addProducto->id_genero;
        $id = $this->model->addProducto($nombre, $descripcion, $precio, $id_genero);
        if($id>0){
            $this->view->response("se agrego el producto",200);
        }
    }
}

    
