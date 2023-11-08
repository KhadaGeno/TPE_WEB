<?php

class ProductosView {

    function showProductos ($productos) {
        require "templates/productos.phtml";
    }

    function showProducto ($producto) {
        require "templates/content.phtml";
    }
}