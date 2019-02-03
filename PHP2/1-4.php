<?php
/**
 * Created by PhpStorm.
 * User: alexandra
 * Date: 03/02/2019
 * Time: 17:25
 */

class Product
{
    protected $id;
    protected $article;
    protected $category;
    protected $title;
    protected $description;
    protected $size;
    protected $price;
    protected $country;
    protected $count;

        public function __construct($article, $category, $title, $description, $size, $price, $country, $count)
        {
            $this->article = $article;
            $this->category = $category;
            $this->title = $title;
            $this->description = $description;
            $this->size = $size;
            $this->price = $price;
            $this->country = $country;
            $this->count = $count;
        }

        public function view (){
            echo "
            <hr><h2>Карточка товара</h2>
            <b>Артикул:</b> $this->article<br>
            <b>Категория:</b> $this->category<br>
            <b>Наименование:</b> $this->title<br>
            <b>Описание:</b> $this->description<br>
            <b>Размер:</b> $this->size<br>
            <b>Цена:</b> $this->price руб.<br>
            <b>Страна-производитель:</b> $this->country<br>
            <b>Количество на складе:</b> $this->count шт.<br>
            ";
        }

        //Списание товара со склада
        public function removeFromStock($nimber)
        {
            echo "<hr><h2>Списание со склада</h2>";
            if (($this->count - $number) < 0){
                echo "<b>Недостаточное количество товара на складе для списания: $number шт.!</b><br>";
            } else{
                $this->couny -= $number;
                echo "<b>Списание товара $this->title в количестве $number шт. выполнено успешно!</b><br>";
            }
            echo "<b>Остаток на складе:</b> $this->count шт.<br>";
        }
}

// Уцененый товар (брак)
class Discount extends Product
{
    public $state;
    public $complete;
    public $package;
    public $reason;

    function __construct($article, $category, $title, $description, $size, $price, $country, $count, $state, $complete, $package, $reason)
    {
      parent::__construct ($article, $category, $title, $description, $size, $price, $country, $count);
      $this->state = $state;
      $this->complete = $complete;
      $this->package = $package;
      $this->reason = $reason;
    }

    public function view()
    {
        parent::view();
        echo "
            <b>Состояние:</b> $this->state<br>
            <b>Комплектность:</b> $this->complete<br>
            <b>Состояние упаковки:</b> $this->package<br>
            <b>Причина уценки:</b> $this->reason<br>
            ";
    }
}

/*Стандартный товар*/
$good1 = new Product(326166, "Пальто", "ШЕРСТЯНОЕ ПАЛЬТО-КЕЙП",
    "Пальто-кейп. Свободный крой, капюшон, застежка на молнию с двумя бегунками, два боковых кармана и длинные рукава.",
    "S", "30 990", "Португалия","7" );
$good1->view();
$good1->removeFromStock(8);
$good1->removeFromStock(2);

/*Уцененный товар*/
$good2 = new Discount(4142497, "Платье", "ПЛАТЬЕ С ЗАПАХОМ И ПУГОВИЦАМИ",
    "Платье с запахом и защипами. А-силуэт, V-образный вырез, застежка на пуговицы сбоку, длинные рукава и манжеты с пуговицами.",
    "S", "10 990", "Португалия", 2, "Не полная", 2,
    "не хаватает пуговицы", "пятна грязи", "затертое", "отличное");
$good2->view();
$good2->removeFromStock(4);
$good2->removeFromStock(1);

var_dump($good1);
var_dump($good2);
