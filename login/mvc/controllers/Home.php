<?php

class Home extends Controller {

    public function Login() {
        $a = $this->model('CompileForm');
        echo $a->dangNhap();
    }

}