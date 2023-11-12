<?php

class ABMView {

    function showAgregar () {
        require "templates/agregar.phtml";
    }

    function showAddProducto ($categorias) {
        require "templates/addProducto.phtml";
    }

    function showAddCategoria () {
        require "templates/addCategoria.phtml";
    }

    function showUpdateProducto ($categorias, $producto) {
        require "templates/updateProducto.phtml";
    }

    function showUpdateCategoria ($categoria) {
        require "templates/updateCategoria.phtml";
    }
}