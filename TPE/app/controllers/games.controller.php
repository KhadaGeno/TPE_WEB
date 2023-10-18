<?php
require_once './app/models/games.model.php';
require_once './app/views/games.view.php';
require_once './app/helpers/auth.helper.php';

class GamesController {
    private $model;
    private $view;

    public function __construct() {
        // verifico logueado
        $this->model = new gamesModel();
        $this->view = new gamesView();
    }

    public function showgames() {    
        $games = $this->model->getgames();
        $this->view->showgames($games);
    }
    public function showfiltercategory($id) {    
        $category = $this->model->filtroCategoria($id);
        $this->view->showgames($category);
        
    }
    public function showContentGame($id){
    $game = $this->model->GetContent($id);
    $this->view->showContentgame($game);
    }

    public function ActualizarCategoria() {
    $isAdmin = AuthHelper::verify(); 
    if($isAdmin == "administrador"){
    $UpCat= $_POST['newCategory'];
        if(isset($_POST['newCategory']) && !empty($_POST['newCategory'])){
        $this->model->updateCategory($UpCat);
        }
    }
    }
}