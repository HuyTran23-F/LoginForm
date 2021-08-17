<?php

class Controller {

    public function model($model) {
        require_once "./mvc/models/".$model.".php";
        $models = new $model;
        return $models;
    }

    public function view($view, $data = []) {
        extract($data);
        require_once "./mvc/views/".$view.".php";
    }

}