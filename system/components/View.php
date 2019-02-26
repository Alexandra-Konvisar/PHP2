<?php

namespace system\components;

use Twig_Loader_Filesystem;
use Twig_Environment;

class View {

    public $layout;
    public $view;

    private $_render;

    public function __construct($controllerName, $layout, $view) {
        $this->layout = $layout;
        $this->view = "{$controllerName}/{$view}";
    }

    public function render(array $params) {
        $loader = new Twig_Loader_Filesystem(
            App::$current->config['components']['twig']['templates']
        );

        $this->_render = new Twig_Environment($loader, array(
            'cache' => App::$current->config['components']['twig']['cache'],
        ));

        try {
            $viewFile = $this->_render->render(
                "{$this->view}.twig",
                $params
            );

//            $user = $this->_render->render(
//                "widgets/user.twig",
//                $params
//            );
//
//            $guest = $this->_render->render(
//                "widgets/loginform.twig"
//            );

            if ($this->layout) {
                $layoutFile = $this->_render->render(
                    "layouts/{$this->layout}.twig",
                    [
                        'app' => App::$current->config['app'],
                        'content' => $viewFile,
//                        'user' => $user,
//                        'guest' => $guest,
                    ]
                );
            } else {
                $layoutFile = $viewFile;
            }
        } catch (\Exception $error) {
            echo $error->getMessage();
            die();
        }


        echo $layoutFile;
    }

}
