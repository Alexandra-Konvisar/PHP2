// Класс корзины

class Basket {
    constructor(idBasket, url) {
        this.id = idBasket;
        this.url = url;
        this.goodId = null;
        this.imgSrc = null;
        this.goodName = null;
        this.goodPrice = null;
        this.goodCount = null;
        this.goodAmount = null;
        this.amount = null;
        this.count = null;
        this.basketItems = [];
    }

    getItems($appendContainer) {
        let self = this;

        $.ajax({
            type: 'GET',
            url: self.url,
            dataType: 'json',
            context: this,
            success: function (data) {
                // let $data1 = $.parseJSON(data);
                console.log(data);

                for (let key in data.basket) {
                    this.basketItems.push(data.basket[key]);

                }
                self.render($appendContainer);
            },

            error: function (error) {
                // console.log('Что-то пошло не так', error);
            }
        });
    }

    render($appendContainer) {
        let $cartSubMenu = $(this.id);
        let $cartCount = $('#cart-count');
        /* console.log(this.basketItems);*/
        if (this.basketItems.length === 0) {
            $cartSubMenu.empty();
            $cartCount.empty();


            $cartSubMenu.css({"display": "none"});
            $cartCount.css({"display": "none"});
            $('.modal-cart').hide();
            return;
            // alert("CART IS EMPTY");
        }

        $cartSubMenu.css({"display": "flex"});
        $cartCount.css({"display": "block"});
        $cartSubMenu.empty();
        $cartCount.empty();



        let $cartTotalPrice = $('<div />', {
            class: "cart-total"
        });

        let $checkBtn = $('<a />', {
            href: "checkout.html",
            class: "cart-checkout-btn",
            text: "CHECKOUT"
        });

        let $goCartBtn = $('<a />', {
            class: "cart-gotocart-btn",
            href: "#",
            text: "GO TO CART"
        });

        let $cartProductList = $('<div />', {
            class: "sub-menu__product-list"
        });


        this.amount = 0;
        this.count = 0;


        for (let key in this.basketItems) {
            this.goodId = parseInt(this.basketItems[key].id_good);
            this.imgSrc = this.basketItems[key].image;
            this.goodName = this.basketItems[key].name;
            this.goodCount =  parseInt(this.basketItems[key].col);
            this.goodPrice = parseInt(this.basketItems[key].price);
            this.goodAmount = parseInt(this.basketItems[key].amount);
            // console.log(this.basketItems[key]);

            this.count += parseInt(this.basketItems[key].col);
            this.amount += parseInt(this.basketItems[key].amount);


            let $cartProduct = $('<div />', {
                class: "cart-product"
            });
            let $cartProductText = $('<div />', {
                class: "cart-product__text"
            });

            let $productTitle = $('<p />', {
                class: "cart-product__title",
                text: this.goodName
            });

            let $cartProductDelete = $('<button />', {
                class: "cart-product__delete-btn",
                'data-id': this.goodId,
                'data-price': this.goodPrice,
            });

            let $cartChange = $('<div />', {
                class: "change"
            });

            $cartProduct.append(`<img src="assets/img/${this.imgSrc}" class="cart-product__img" alt="Layer">`);

            $cartProductText.append($productTitle);
            $cartProductText.append('<div class="cart-product__star-rat"><span class="ratings two-half"></span></div>');

            $cartChange.append(`<button class="change__btn" data-id="${this.goodId}" data-price="${this.goodPrice}" data-sign="minus"></button><input type="text" class="change__count" value="${this.goodCount}"><button class="change__btn" data-id="${this.goodId}" data-price="${this.goodPrice}" data-sign="plus"></button>`);
            $cartProductText.append($cartChange);
            $cartProductText.append(`<p><span>${this.goodCount}<span/> x <span>${this.goodPrice}$</span><p/>`);
            $cartProduct.append($cartProductText);
            $cartProduct.append($cartProductDelete);
            $cartProductList.append($cartProduct);

        }
        // console.log(this.count);
        $cartCount.append(this.count);
        $cartSubMenu.append($cartProductList);
        $cartTotalPrice.append(`<p>TOTAL</p><p class="total-price">${this.amount}$</p>`);
        $cartSubMenu.append($cartTotalPrice);
        $cartSubMenu.append($checkBtn);
        $cartSubMenu.append($goCartBtn);


        $cartSubMenu.appendTo($appendContainer);

        $($cartProductList).niceScroll({
            cursoropacitymin: "0.5",
            cursorcolor: "#CCCCCC",
        });
    }

    add(id, name, price, img) {
        let basketItem = {
            "id_good": id,
            "price": price,
            "image": img,
            "name": name,
            "col": "1",
            "amount": 0
        };
        /*
        если ай ди по кнопке равно ай ди одного из товаров в массиве товаров,
        то мы просто прибавляем к цене товара из массива, цену по кнопке и к количеству, прибавляем
        единицу. В массив с товарами ничего не кладем.
        иначе берем товар по кнопке и добавляем в массив с товарами.
         */
        id = parseInt(id);
        let $cartSubMenu = $(this.id);
        let $cartCount = $('#cart-count');
        $cartSubMenu.css({"display": "flex"});
        $cartCount.css({"display": "block"});
        for (let key in this.basketItems) {
            this.basketItems[key].id_good = parseInt(this.basketItems[key].id_good);
            // console.log(typeof this.basketItems[key].id_good);
            if (this.basketItems[key].id_good === id) {
                // console.log('равны');
                this.basketItems[key].col = parseInt(this.basketItems[key].col);
                this.basketItems[key].col++;
                this.basketItems[key].amount += price;
                // console.log(basketItem);
                return this.render();
            } else {
                console.log(this.basketItems[key].id_good + 'its' + id);
                console.log(this.basketItems);
            }
        }

        for (let key in this.basketItems) {
            if (parseInt(this.basketItems[key].id_good) !== parseInt(id)) {
                basketItem.amount = price;
                this.basketItems.push(basketItem);

                return this.render();
            }
        }

        if (this.basketItems.length === 0) {
            basketItem.amount = price;
            this.basketItems.push(basketItem);
            console.log(this.basketItems);
            return this.render();
        }
    }

    changeInput(id, price, sign) {
        for (let key in this.basketItems) {
            if (parseInt(this.basketItems[key].id_good) === parseInt(id) && sign === 'plus') {
                // console.log(this.basketItems[key].count);
                this.basketItems[key].col = parseInt(this.basketItems[key].col);
                this.basketItems[key].col++;
                // console.log(this.basketItems[key].col);
                this.basketItems[key].amount += parseInt(price);
                return this.render();
            }
        }

        for (let key in this.basketItems) {
            if (parseInt(this.basketItems[key].id_good) === parseInt(id) && sign === 'minus' && parseInt(this.basketItems[key].col) > 1) {
                this.basketItems[key].col = parseInt(this.basketItems[key].col);
                this.basketItems[key].col--;
                this.basketItems[key].amount -= parseInt(price);
                return this.render();
            }
        }
    }

    remove(id) {
        for (let key in this.basketItems) {
            if (parseInt(this.basketItems[key].id_good) === parseInt(id) || this.basketItems.length !== 0) {
                this.goodCount--;
                this.amount -= this.basketItems[key].amount;
                this.basketItems.splice(this.basketItems[key], 1);
                return this.render();
            }
        }
    }
}
