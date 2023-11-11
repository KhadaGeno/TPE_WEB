<?php

require_once "./app/views/amb.view.php";
require_once "./app/models/productos.model.php";
require_once "./app/models/categoria.model.php";
require_once "./app/views/error.view.php";

class AMBController {

    private $ambView;
    private $productosModel;
    private $categoriaModel;
    private $errorView;

    function __construct () {
        $this->ambView = new AMBView();
        $this->productosModel = new ProductosModel;
        $this->categoriaModel = new CategoriaModel;
        $this->errorView = new ErrorView();
    }

    function showAgregar () {
        if (AuthHelper::verify()) {
            $this->ambView->showAgregar();
        } else {
            header('Location: ' . HOME);
        }
    }

    function showAddProducto () {
        if (AuthHelper::verify()) {
            $categorias = $this->categoriaModel->getCategorias();
            $this->ambView->showAddProducto($categorias);
        } else {
            header('Location: ' . HOME);
        };
    }

    function addProducto () {
        if (AuthHelper::verify()) {
            if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['categoria'])) {
                $this->errorView->showError("Falta completar datos");
                return;
            }

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['categoria'];

            $categoria = $this->categoriaModel->getCategoriaUnica($id_categoria);
            if (!$categoria) {
                $this->errorView->showError("Su categoria no existe");
                return;
            }

            $productos = $this->productosModel->getProductos();
            foreach ($productos as $producto) {
                if ($nombre == $producto->nombre) {
                    $this->errorView->showError("El producto ya existe");
                    return;
                }
            }

            $this->productosModel->addProducto($nombre, $descripcion, $precio, $id_categoria);
            header('Location: ' . JUEGOS);
        } else {
            header('Location: ' . HOME);
        }
    }

    function showUpdateProducto ($id) {
        if (AuthHelper::verify()) {
            $categorias = $this->categoriaModel->getCategorias();
            $this->ambView->showUpdateProducto($categorias, $id);
        } else {
            header('Location: ' . HOME);
        };
    }

    function updateProducto ($id_producto) {
        if (AuthHelper::verify()) {
            if (empty($_POST['nombre']) || empty($_POST['descripcion']) || empty($_POST['precio']) || empty($_POST['categoria'])) {
                $this->errorView->showError("Falta completar datos");
                return;
            }

            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $precio = $_POST['precio'];
            $id_categoria = $_POST['categoria'];

            $productos = $this->productosModel->getProductos();
            foreach ($productos as $producto) {
                if ($nombre == $producto->nombre) {
                    $this->errorView->showError("Ya existe un producto con este nombre");
                    return;
                }
            }
            $this->productosModel->updateProducto($nombre, $descripcion, $precio, $id_categoria, $id_producto);
            header('Location: ' . JUEGOS);
        } else {
            header('Location: ' . HOME);
        }
    }

    function deleteProducto ($id) {
        if (AuthHelper::verify()) {
            $this->productosModel->deleteProducto($id);
            header('Location: ' . JUEGOS);
        } else {
            header('Location: ' . HOME);
        }
    }

    function showAddCategoria () {
        if (AuthHelper::verify()) {
            $this->ambView->showAddCategoria();
        } else {
            header('Location: ' . HOME);
        }
    }

    function addCategoria () {
        if (AuthHelper::verify()) {
            if (empty($_POST['nombre'])) {
                $this->errorView->showError("Falta completar datos");
                return;
            }
            $nombre = $_POST['nombre'];
    
            $categorias = $this->categoriaModel->getCategorias();
            foreach ($categorias as $categoria) {
                if ($nombre == $categoria->nombre) {
                    $this->errorView->showError("La categoria ya existe");
                    return;
                }
            }
    
            $this->categoriaModel->addCategoria($nombre);
            header('Location: ' . HOME);
        } else {
            header('Location: ' . HOME);
        }
    }

    function showUpdateCategoria ($id) {
        if (AuthHelper::verify()) {
            $this->ambView->showUpdateCategoria();
        } else {
            header('Location: ' . HOME);
        }
    }

    function deleteCategoria ($id) {
        if (AuthHelper::verify()) {
            $productos = $this->productosModel->getProductos();
            $productosLigados = 0;
            foreach ($productos as $producto) {
                $productosLigados++;
            }
            if ($productosLigados == 0) {
                $this->categoriaModel->deleteCategoria($id);
                header('Location: ' . HOME);
            } else {
                $this->errorView->showError("No se puede borrar esta categoria");
            }
        } else {
            header('Location: ' . HOME);
        }
    }
}