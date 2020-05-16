<?php

    // function autoload($class){
    //     include "classes/" . $class . ".php";        
    // }

    // spl_autoload_register('autoload');
 
    interface Address{
        public function myCity();
        public function myStreet();
    }

    abstract class Data{
        abstract public function myData();       
        abstract public function myDataObject(); 
    }

    class User implements Address
    {
        use Money, Shop;

        public $name;
        public $age;                
        public $year = 2019;
        public $money;
        public $products;
        public static $state = "active";
        
        public function __construct($name, $age, $city, $street){
            $this->name = $name;
            $this->age = $age;
            $this->city = $city;
            $this->street = $street;
        }

        public function myName(){
            echo "My name is " . $this->name . " and my state is " . self::$state . "<br>";
        }

        public function myAge(){
            echo "My age is " . $this->age . " in year " . $this->year . "<br>";
            $this->getBirthday();            
        }

        private function getBirthday(){
            $birthday = $this->year - $this->age;
            echo "I was born in " . $birthday . "<br>";
        }

        public function callPremiumMessage(){
            echo premiumUser::premiumMessageOut();
        }

        public function myCity(){
            echo "I live in " . $this->city . "<br>";
        }

        public function myStreet(){
            echo "On the " . $this->street . " street <br>";
        }

        public function setMoney($money){
            $this->money = $money;
        }

        public function setShop($products){
            $this->products = $products;
        }
    }

    class PremiumUser extends User{
        public function myAge(){
            echo "My name is " . $this->name . ", I'm " . $this->age . " in year " . $this->year . " and I'm a Premium User <br>";
            self::premiumMessage();
        }

        public static function premiumMessage(){
            echo "This message can only be viewed by premium users <br>";
        }

        public static function premiumMessageOut(){
            echo "This message is a premium message called from outside the class <br>";
        }
    }

    class BasicData extends Data{
        public function __construct($data){
            $this->data = $data;
        }

        public function myData(){
            $data = $this->data;
            $json = json_encode($data);                        
            echo "My data: " . $json . "<br>";      
        }

        public function myDataObject(){
            $test = new stdClass;
            $test->numberOne = 1;
            $test->numberTwo = 2;
            $test->numberthree = 3;
            $json = json_encode($test);
            echo "My data object: " . $json . "<br>";  
        }
    }

    trait Money{
        public $money;
        
        public function getMoney(){
            echo "I have " . $this->money . " in my account <br>";
        }

        abstract function setMoney($money);
    }

    trait Shop{
        public $products;
        
        public function getShop(){
            echo "Shop: <br>";
            foreach($this->products as $k => $value){
                echo "&emsp;" . $value . "<br>";
            }
        }

        abstract function setShop($products);
    }

$user = new User('Juan', '30', 'Santiago', 'Alameda');
$user->myName();
$user->myAge();
$user->myCity();
$user->myStreet();
$user->setMoney(50000);
$user->getMoney();
$user->setShop(array('Chocolate', 'Beer', 'Chicken', 'Potato'));
$user->getShop();
$premiumUser = new PremiumUser('Carlos', '20', 'Santiago', 'Vespucio');
$premiumUser->myAge();
$premiumUser->myCity();
$premiumUser->myStreet();
echo premiumUser::premiumMessageOut();
$data = array('name' => 'Juan', 'country' => 'Chile', 'gender' => 'M');
$basicData = new BasicData($data);
$basicData->myData();
$basicData->myDataObject();
