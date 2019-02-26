$(document).ready(function () {
    // Кнопка вверх (быстрая прокрутка страницы)
    $('body').append('<button class="btn-up" />');

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 500) {
            $('.btn-up').fadeIn();
        } else {
            $('.btn-up').fadeOut();
        }
    });

    $(document).on('click', '.btn-up', function () {
       $('body').animate({'scrollTop': 0}, 2000);
       $('html').animate({'scrollTop': 0}, 2000);
    });

    // Выпадающее меню в форме поиска
    $(document).on('click', '.browse-box__title', function(){
        $('.browse-box__list').slideToggle(500);
        console.log(this);
        $('.browse-box__title .fa').toggleClass('active');
    });

    // toggle my account panel visibility
    // $('#my-account-btn').on('click', function () {
    //     togglePanelVisible($('#my-account-panel'), $('#my-account-btn'), -14, 16);
    // });
    //
    // // function for toggle panel's visibility
    // function togglePanelVisible($panel, $object, adjustX, adjustY) {
    //     $panel.css({top: $object.offset().top + $object.height() + adjustY, left: $object.offset().left + adjustX})
    //     $panel.toggleClass('show');
    // }

    $(document).on('click', '.account-btn', function () {
        console.log('OK');
        // $(this).next('#login-content').slideToggle();
        $('.my-account-panel').slideToggle(500);
        // $('#my-account-panel').toggleClass('show');
    });
        // if ($('#login-trigger').hasClass('active')) $('#login-trigger').find('span').html('&#x25B2;');
        // else $('#login-trigger').find('span').html('&#x25BC;');
    // Рендеринг товаров в случайном порядке
    // let $goods = $('.products-list');
    // let arr = [];
    // let $goodItemCount = 8;
    // for (let i = 1; i < 20; i++) {
    //     arr[i - 1] = i;
    // }
    //
    // let shuffle = function(array) {
    //     let random = array.map(Math.random);
    //     array.sort(function(a, b) {
    //         return random[a] - random[b];
    //     });
    // };
    //
    // shuffle(arr);
    //
    //  for (let j = 0; j < $goodItemCount; j++) {
    //      let $goodItemId = arr[j];
    //      new Good (String($goodItemId))
    //         .getGoods($goods);
    // }
});