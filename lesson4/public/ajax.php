<?php
include_once "../models/db_goods.php";
$goods = goods_ajax($link);
if (empty($goods)) {
// если товаров нет
    echo json_encode(array(
        'result' => 'finish'
    ));
} else {
// если товары получили из базы, то сформируем html элементы
// и отдадим их клиенту
    $html = "";
    foreach ($goods as $good) {
        $html .= "
                <div class=\"item col-3\">
                    <a href=\"item.php?id={$good['id']}\"><img src=\"{$good['small_src']}\" alt=\"{$good['name']}\"
                                                                  title=\"{$good['name']}\"></a>
                    <h3 class=\"item-name\"><a href=\"item.php?id={$good['id']}\">{$good['name']}</a></h3>
                    <p class=\"price\">{$good['price']}р.</p>
                    <p class=\"add-to-basket\"><a href=\"#\" title=\"Добавить в корзину\">Купить</a></p>
                </div>
            ";
    }
    echo json_encode(array(
        'result' => 'success',
        'html' => $html
    ));
}