<?php
define("TITLE","Магазинчик волшебства | Главная");
include_once "../models/db_goods.php";

include "../templates/header.php"; ?>
<h1>Магазинчик волшебства</h1>
<h2>Чудеса, да и только!</h2>
<img src="img/main.jpg" class="main_img" />
<p>
    Приветствую тебя, усталый путник, в месте, где всё поразит твоё воображение.
</p>
<p>
    Усаживайся поудобнее и заходи в самый удивительный каталог магической всячины. Но не задерживайся надолго! Товар не залёживается, поэтому поскорее заказывай то, что выберет твоё сердце, пока его не выбрал другой искатель.
</p>
<p><a href="./catalog/catalog.html">В каталог <b>-></b></a></p>
<div class="leftblock">
    <? include "../templates/menu.php"; ?>
</div>
<div class="content">
    <h1>Интернет-магазин ноутбуков</h1>
    <p class="hello">Добро пожаловать в наш интернет-магазин ноутбуков, у нас огромный ассортимент комплектующих и расходных материалов для ремонта ноутбуков, планшетов и телефонов. </p>
    <hr>
    <?php
    $goods = goods_all($link);
    if($goods){
        foreach ($goods as $good){?>
            <div class="item">
                <a href="item.php?id=<?=$good[id]?>"><img src="<?=$good[small_src]?>" alt="<?=$good[name]?>" title="<?=$good[name]?>"></a>
                <h3 class="item-name"><a href="item.php?id=<?=$good[id]?>"><?=$good[name]?></a></h3>
                <p class="price"><?=$good[price]?>р.</p>
                <p class="add-to-basket"><a href="#" title="Добавить в корзину">Купить</a></p>
            </div>
        <?}
    }
include "../templates/footer.php"; ?>