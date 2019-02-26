$(document).ready(function () {

    $(document).on('click', '.change__btn', function () {
        // let id = parseInt($(this).attr('data-id'));
        let $id = $(this).attr('data-id');
        let $price = $(this).attr('data-price');
        let $sign = $(this).attr('data-sign');

        // basketModal.changeInput(id, price, sign);

        console.log($id);
        console.log($price);
        console.log($sign);

        $.ajax({
            url: "/basket/change/",
            type: "POST",
            dataType: 'json',
            data: {
                id_good: $id,
                price: $price,
                sign: $sign
            },

            error: function (error) {
                // console.log(error);
            }

        });

        basket.changeInput($id, $price, $sign);
    });

    //Корзина в выпадающем меню
    // let $basketGood = [];
    // $('[data-id], [data-name], [data-price], [data-src]').each( function(e){
    //     let $el = $(this);
    //
    //     if($el.hasClass('cart-product__delete-btn')) {
    //         $basketGood.push({"id_product" : parseInt($el.attr('data-id')), "name": $el.attr('data-name'),
    //             "price": parseInt($el.attr('data-price')), "src": $el.attr('data-src')});
    //     }
    // });
    let $basketSubContainer = $('.cart-menu');
    let $url = "/basket/get/";

    let basket = new Basket('#sub-menu', $url);
    basket.getItems($basketSubContainer);

    // let $basketModalContainer = $('.modal-cart');

    let $basketModalContainer = $('.modal-cart');
    let basketModal = new Basket('#modal-menu', $url);
    basketModal.getItems($basketModalContainer);

    // $('[data-id]').each( function(e){
    //     var $el = $(this);
    //     if($el.hasClass('.cart-product .cart-product__delete-btn')) {
    //         console.log($el.attr('data-id'))
    //     }
    // });
    // let $arrGoodId = [];


    // $('[data-name]').each( function(e){
    //     let $el = $(this);
    //
    //     if($el.hasClass('cart-product__delete-btn')) {
    //         $basketGood.push({"name" : $el.attr('data-name')});
    //     }
    // });

    // console.log($basketGood);
    // let $arrGoodId = $(".cart-product .cart-product__delete-btn").attr('data-id');
    // console.log($arrGoodId);
    $(document).on('click', '.buy', function () {
        let price = parseInt($(this).attr('data-price'));
        let name = $(this).attr('data-name');
        let img = $(this).attr('data-img');
        let id = parseInt($(this).attr('data-id'));

        basket.add(id, name, price, img);

        basketModal.add(id, name, price, img);
        // console.log($arrGoodId);
        $.ajax({
            url: "/basket/buy/",
            type: "POST",
            dataType: "json",
            data: {
                id_good: id,
                amount: price
            },
            error: function (error) {
                console.log(error);
            }

        });
    });



    $(document).on('click', '.cart-product__delete-btn', function () {
        let id = $(this).attr('data-id');


        $.ajax({
            url: "/basket/delete/",
            type: "POST",
            dataType: "json",
            data: {
                id_good: id
            },
            error: function (error) {
                console.log(error);
            }

        });

        basket.remove(id);
        basketModal.remove(id);
    });

    // Корзина в модальном окне
    $('.modal-cart').hide();
    $(document).on('click', '.modal-cart', function () {
        $('.modal-cart').hide();
    });
    $(document).on('click', '.modal-menu', function () {
        return false;
    });
    $(document).on('click', '.cart-gotocart-btn', function () {
        $('.modal-cart').css({"display": "flex"});
        $('.modal-cart').show();
    });
});