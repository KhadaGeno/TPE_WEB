<?php

require_once "./app/views/abm.view.php";
require_once "./app/models/productos.model.php";
require_once "./app/models/categoria.model.php";
require_once "./app/views/error.view.php";

class ABMController {

    private $abmView;
    private $productosModel;
    private $categoriaModel;
    private $errorView;

    function __construct () {
        $this->abmView = new ABMView();
        $this->productosModel = new ProductosModel;
        $this->categoriaModel = new CategoriaModel;
        $this->errorView = new ErrorView();
    }

    function showAgregar () {
        if (AuthHelper::verify()) {
            $this->abmView->showAgregar();
        } else {
            header('Location: ' . HOME);
        }
    }

    function showAddProducto () {
        if (AuthHelper::verify()) {
            $categorias = $this->categoriaModel->getCategorias();
            $this->abmView->showAddProducto($categorias);
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
                $this->errorView->showError("La categoria no existe");
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
            $producto = $this->productosModel->getProductoUnico($id);
            if ($producto) {
                $categorias = $this->categoriaModel->getCategorias();
                $this->abmView->showUpdateProducto($categorias, $producto);
            } else {
                $this->errorView->showError("El producto no existe");
            }
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

            $producto = $this->productosModel->getProductoUnico($id_producto);
            if (!$producto) {
                $this->errorView->showError("El producto no existe");
                return;
            }

            $productos = $this->productosModel->getProductosMenosUno($id_producto);
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
            $this->abmView->showAddCategoria();
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
            $categoria = $this->categoriaModel->getCategoriaUnica($id);
            if (!$categoria) {
                $this->errorView->showError("La categoria no existe");
                return;
            }
            $this->abmView->showUpdateCategoria($categoria);
        } else {
            header('Location: ' . HOME);
        }
    }

    function updateCategoria ($id) {
        if (AuthHelper::verify()) {
            if (empty($_POST['nombre'])) {
                $this->errorView->showError("Falta completar datos");
                return;
            }

            $nombre = $_POST['nombre'];

            $categoria = $this->categoriaModel->getCategoriaUnica($id);
            if (!$categoria) {
                $this->errorView->showError("La categoria no existe");
                return;
            }

            $categorias = $this->categoriaModel->getCategoriasMenosUna($id);
            foreach ($categorias as $categoria) {
                if ($nombre == $categoria->nombre_gen) {
                    $this->errorView->showError("Ya existe una categoria con este nombre");
                    return;
                }
            }
            $this->categoriaModel->updateCategoria($nombre, $id);
            header('Location: ' . HOME);
        } else {
            header('Location: ' . HOME);
        }
    }

    function deleteCategoria ($id) {
        if (AuthHelper::verify()) {
            $productos = $this->productosModel->getProductosPorIdGenero($id);
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