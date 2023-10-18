<?php

class gamesView {
    public function showgames($games) {
        require 'templates/header.phtml';
        require 'templates/gameList.phtml';
        require 'templates/footer.phtml';
    }
    public function showContentgame($game){
        require 'templates/header.phtml';
        require 'templates/content.phtml';
        require 'templates/footer.phtml';
    }
    public function showError($error) {
        require 'templates/error.phtml';
    }
}