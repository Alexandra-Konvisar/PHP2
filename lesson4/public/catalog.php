<?php
include_once "../models/db_goods.php";
CONST TITLE = 'Магазинчик волшебства';
include "../templates/header.php"; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">Каталог</li>
        </ol>
    </nav>
    <h1>Каталог товаров</h1>
    <div class="row" id="goods">

        <?php
        $goods = goods_limit($link);
        if ($goods) {
            foreach ($goods as $good) {
                ?>
                <div class="item col-3">
                    <a href="item.php?id=<?= $good['id'] ?>"><img src="<?= $good['small_src'] ?>"
                                                                  alt="<?= $good['name'] ?>"
                                                                  title="<?= $good['name'] ?>"></a>
                    <h3 class="item-name"><a href="item.php?id=<?= $good['id'] ?>"><?= $good['name'] ?></a></h3>
                    <p class="price"><?= $good['price'] ?>р.</p>
                    <p class="add-to-basket"><a href="#" title="Добавить в корзину">Купить</a></p>
                </div>
                <?
            }
        }

        ?>
    </div>
    <input id="show_more" count_show="4" count_add="4" type="button" value="Показать еще" class="btn btn-info">
    <script>
        $(document).ready(function () {

            $('#show_more').click(function () {
                var btn_more = $(this);
                var count_show = parseInt($(this).attr('count_show'));
                var count_add = $(this).attr('count_add');
                btn_more.val('Подождите...');

                $.ajax({
                    url: "ajax.php", // куда отправляем
                    type: "post", // метод передачи
                    dataType: "json", // тип передачи данных
                    data: { // что отправляем
                        "count_show": count_show,
                        "count_add": count_add
                    },
                    // после получения ответа сервера
                    success: function (data) {
                        if (data.result == "success") {
                            $('#goods').append(data.html);
                            btn_more.val('Показать еще');
                            btn_more.attr('count_show', (parseInt(count_show) + parseInt(count_add)));
                        } else {
                            btn_more.val('Больше нечего показывать');
                        }
                    }
                });
            });

        });
    </script>
<? include "../templates/footer.php"; ?>