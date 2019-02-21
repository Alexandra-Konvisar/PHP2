<?php
namespace application\core;
class Router
{
    protected $routes=[];
    protected $params=[];
    function __construct() {
        $arr = require 'application/config/routes.php';
        //debug($arr);
        foreach ($arr as $key => $val){
            $this->add($key, $val);
        }
        
               
    }
    public function add($route, $params){
        $route = '#^'.$route.'$#';//регулярное выражение поиска маршрута
        $this -> routes[$route] = $params;
        
    }
    //Функция, которая проверяет существует ли маршрут
    public function match(){
        
        $url = trim($_SERVER['REQUEST_URI'],'/');
        
        foreach ($this->routes as $route => $params){
            
            if(preg_match($route, $url, $matches)){
                $this->params = $params;
                return true;
                
            }
        }
        return FALSE;
    }
    public function run(){
        if($this->match()){
            $path = 'application\controllers\\'.ucfirst($this-> params['controller']).'Controller';
            if(class_exists($path)){
                $action = $this->params['action'].'Action';
                if (method_exists($path, $action)){
                    $controller = new $path($this->params);
                    $controller -> $action();
                    
            }else{
                echo 'Action is not found '.$action;
            }
            }else{
                echo 'Controller is not found '.$path;
            }
        }
        else {
            echo 'Route is not found!';
     
        }
    
    }
}
