<?php

class App {

    protected $controller  = "Home";
    protected $action  = "Login";
    protected $params  = [];

    public function __construct()
    {
        //Array ( [0] => Home [1] => Actions [2] => 1 [3] => 2 [4] => 3 ) linh truy cap
        $arrUrl = $this->urlProcess();
        // print_r($arrUrl);

        //Kiem tra controller
        if(file_exists("./mvc/controllers/". $arrUrl[0].".php")) 
        {
            $this->controller = $arrUrl[0];
            unset($arrUrl[0]);
        }

        require_once "./mvc/controllers/". $this->controller .".php";
        $this->controller = new $this->controller;
        //Kiem tra Action/method 
        if(isset($arrUrl[1])) 
        {
            if(method_exists($this->controller, $arrUrl[1])) 
            {
                $this->action = $arrUrl[1];
            }
            unset($arrUrl[1]);
        }   
        
        //Kiem tra params
        $this->params = $arrUrl ? array_values($arrUrl) : [];
        call_user_func_array([$this->controller, $this->action], $this->params);
    }


    // Kiem tra Url
    public function urlProcess() 
    {
        if( isset($_GET["url"]))
        {
            return explode("/", filter_var(trim($_GET["url"], "/")));
        }
    }
}