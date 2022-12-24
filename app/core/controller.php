<?php 

class Controller
{
    public function checkAuth()
    {
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: /auth/login");
            exit;
        }
    }

    public function view($view, $data = [])
    {
        if(file_exists(PROJ_ROOT . "/app/views/". $view  . ".php"))
        {
            include PROJ_ROOT . "/app/views/". $view  . ".php";
        } else {
            include PROJ_ROOT . "/app/views/404.php";
        }
    }

    public function loadModel($model)
    {
        if(file_exists(PROJ_ROOT . "/app/models/". $model  . ".php"))
        {
            include PROJ_ROOT . "/app/models/". $model  . ".php";
            return $model = new $model();
        }

        return false;
    }
}