<?php
namespace app\frontend\controllers;

use system\components\Controller;
use app\frontend\models\Goods;


class GoodsController extends Controller {
    public function actionGet() {
        $limit = (int)$_GET['limit'];
        $goods = Goods::findLimit($limit);
        echo json_encode(["goods" => $goods]);
    }

    public function actionAdd() {
        $limit = (int)$_GET['limit'];
        $max = ", " . (int)$_GET['limit_max'];
        $goods = Goods::findLimit($limit, $max);
        echo json_encode(["goods" => $goods]);
    }
}