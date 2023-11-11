<?php

class ProductosView {

    function showProductos ($productos) {
        require "templates/productos.phtml";
    }

    function showProducto ($producto, $categoria) {
        require "templates/content.phtml";
    }
}