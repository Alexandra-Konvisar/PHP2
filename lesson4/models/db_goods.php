<?php
require_once "db.php";
function goods_limit($link)
{
    $sql = mysqli_query($link, "SELECT * FROM goods LIMIT 4") or die(mysqli_error());
    $goods = array();
    while ($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $goods[] = $result;
    }

    return $goods;
}

function goods_ajax($link)
{
    $countView = (int)$_POST['count_add'];  // количество записей, получаемых за один раз
    $startIndex = (int)$_POST['count_show']; // с какой записи начать выборку

    $sql = mysqli_query($link, "SELECT * FROM goods LIMIT $startIndex, $countView") or die(mysqli_error());
    $goods = array();
    while ($result = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
        $goods[] = $result;
    }

    return $goods;
}