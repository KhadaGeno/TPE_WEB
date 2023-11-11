<?php

class AMBView {

    function showAgregar () {
        require "templates/agregar.phtml";
    }

    function showAddProducto ($categorias) {
        require "templates/addProducto.phtml";
    }

    function showAddCategoria () {
        require "templates/addCategoria.phtml";
    }

    function showUpdateProducto ($categorias, $id) {
        require "templates/updateProducto.phtml";
    }

    function showUpdateCategoria () {
        require "templates/updateCategoria.phtml";
    }
}