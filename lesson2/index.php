<?php
/**
 * Created by PhpStorm.
 * User: alexandra
 * Date: 11/02/2019
 * Time: 23:23
 */

/*Абстрактынй класс*/

abstract class  Product
{
    protected $id;
    protected $name;
    protected $description;
    protected $price;

    protected function __construct($id, $name, $description, $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    abstract protected function getPrice();

    abstract protected function getRevenue();
}

/*Доход с продаж, одинаковый для всех товаров*/

trait Revenue
{
    public function getRevenue()
    {
        return ($this->getPrice()) * 0.05;
    }
}

/*Класс цифрового товара*/

class ProductDigital extends Product
{
    use Revenue;

    public function getPrice()
    {
        return ($this->price) / 2;
    }

    function __construct($id, $name, $description, $price)
    {
        parent:: __construct($id, $name, $description, $price);
    }
}

/*Класс штучного товара*/

class ProductPiece extends Product
{
    use Revenue;

    public function getPrice()
    {
        return $this->price;
    }

    function __construct($id, $name, $description, $price)
    {
        parent:: __construct($id, $name, $description, $price);
    }
}

/*Класс товара по весу*/

class ProductByWeight extends Product
{
    use Revenue;

    private $weight;

    function __construct($id, $name, $description, $price, $weight)
    {
        parent:: __construct($id, $name, $description, $price);
        $this->weight = $weight;
    }

    public function getPrice()
    {
        return ($this->price) * ($this->weight);
    }
}

$item1 = new ProductDigital(1, 'Первый товар', 'Описание', 100);
echo $item1->getPrice() . '<br>';

$item2 = new ProductPiece(2, 'Второй товар', 'Описание', 100);
echo $item2->getPrice() . '<br>';

$item3 = new ProductByWeight(3, 'Товар 3', 'Описание', 100, 10);
echo $item3->getPrice() . '<br>';

$revenue1 = $item1->getRevenue();
$revenue2 = $item2->getRevenue();
$revenue3 = $item3->getRevenue();

echo "Доход 1: $revenue1 <br> Доход 2: $revenue2<br> Доход 3: $revenue3  <br> ";


/*    2. *Реализовать паттерн Singleton при помощи traits.*/

trait Singleton
{
    private static $instance; // Экземпляр объекта

    // Защищаем от создания через new Singleton
    private function __construct()
    { /* ... @return Singleton */
    }

    // Защищаем от создания через клонирование
    private function __clone()
    { /* ... @return Singleton */
    }

    // Защищаем от создания через unserialize
    private function __wakeup()
    { /* ... @return Singleton */
    }

    // Возвращает единственный экземпляр класса.
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

class MyClass
{
    use Singleton;

    public function test() {
        echo 'Тест';
    }

}

MyClass::getInstance()->test();

