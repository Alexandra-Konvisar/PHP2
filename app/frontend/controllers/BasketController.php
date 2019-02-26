<?php
namespace app\frontend\controllers;

use app\frontend\models\Basket;
use system\components\Controller;


class BasketController extends Controller {

    public function actionBuy() {
        $id_session = $_SESSION['id'];
        $id_good = $_POST['id_good'];
        $count = 1;
        $price = $_POST['amount'];

        $id_user = NULL;
        $amount = $price;

        $id_order = NULL;
        $is_in_order = 1;

        $basketUser = Basket::findParam($id_good, $id_session);

        $newBasket = new Basket();

        $newBasket->id_good = $id_good;
        $newBasket->price = $price;
        $newBasket->is_in_order = $is_in_order;
        $newBasket->id_session = $id_session;
        $newBasket->col = $count;
        $newBasket->amount = $amount;


        if ($basketUser == []) {
            $newBasket->save();
        } else {
            foreach ($basketUser as $item) {
                if ($item->id_good == $id_good) {
                    Basket::updPlus($price, $id_good, $id_session);
                } else {
                    $newBasket->save();
                }
            }
        }
    }

    public function actionChange() {
        $id_session = $_SESSION['id'];
//        echo $_POST;
        $sign = $_POST['sign'];
        $id_good = $_POST['id_good'];
        $price = $_POST['price'];



//        echo $sign . "<br>";
//        echo $id_good . "<br>";
//        echo $price . "<br>";
//        echo $id_session . "<br>";

        $basketGood = Basket::findParam($id_good, $id_session);


//        var_dump($basketGood);
//        $count = $basketGood->col;

        foreach ($basketGood as $item) {
            if ($item->col > 1 and $sign == "minus") {
                Basket::updMin($price, $id_good, $id_session);
            }
            if ($item->col > 1 and $sign == "plus") {
                Basket::updPlus($price, $id_good, $id_session);
            }
        }

    }

    public function actionDelete() {
        $id_good = $_POST['id_good'];

        Basket::del($id_good);
    }

    public function actionGet() {
        $table = 'goods';
        $column = 'id_good';

        $basket = Basket::findJoin($table, $column);

        echo json_encode(["basket" => $basket]);
    }
}