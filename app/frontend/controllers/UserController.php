<?php

namespace app\frontend\controllers;

use system\components\Controller;
use app\frontend\models\User;

class UserController extends Controller
{


    public function actionLogin() {
        $login = strip_tags(htmlspecialchars(trim($_POST['login'])));
        $password = md5(trim($_POST['password']));
        $user = User::findOne(['user_login' => $login]);

        if (!empty($user) and $password == $user->{'user_password'}) {
            $_SESSION['user_id'] = $user->{'UID'};
            header("Location: /");
        } else {
            header("Location: /");
        }
    }

    public function actionLogout() {
        unset($_SESSION['user_id']);
        session_destroy();
        header("Location: /");


//        session_unset();
//        session_destroy();
//        session_start();
//        header("Location: /");
    }

    public function actionRegister() {

    }
}
