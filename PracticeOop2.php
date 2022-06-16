<?php
abstract class Country 
{
    protected $slogan;

    public function setSlogan($slogan) {
        $this->slogan = $slogan;
    }
    public function getSlogan() {
        return $this->slogan;
    }

    public function sayHello() {
    }
}

interface Boss 
{
    public function checkValidSlogan();
}

trait Active 
{
    public function defindYourSelf() 
    {
        return get_class($this);
    }
}

class EnglandCountry extends Country implements Boss
{
    use Active;
    public function checkValidSlogan()
    {
        if (0 < strlen(strstr(strtolower($this->getSlogan()), 'england')) || 0 < strlen(strstr(strtolower($this->getSlogan()), 'english'))) {
            return true;
        }
        return false;
    }
    public function sayHello() {
        echo 'Hello';
    }
}
class VietnamCountry extends Country implements Boss
{
    use Active;
    public function checkValidSlogan()
    {
        if (0 < strlen(strstr(strtolower($this->getSlogan()), 'vietnam')) && 0 < strlen(strstr(strtolower($this->getSlogan()), 'hust'))) {
            return true;
        }
        return false;
    }
    public function sayHello() {
        echo 'Xin chào';
    }
}

$englandCountry = new EnglandCountry();
$vietnamCountry = new VietnamCountry();

$englandCountry->setSlogan('England is a country that is part of the United Kingdom. It shares land borders with Wales to the west and Scotland to the north. The Irish Sea lies west of England and the Celtic Sea to the southwest.');

$vietnamCountry->setSlogan('Vietnam is the easternmost country on the Indochina Peninsula. With an estimated 94.6 million inhabitants as of 2016, it is the 15th most populous country in the world.');

$englandCountry->sayHello(); // Hello
echo "<br>";
$vietnamCountry->sayHello(); // Xin chao

echo "<br>";

var_dump($englandCountry->checkValidSlogan()); // true
echo "<br>";
var_dump($vietnamCountry->checkValidSlogan()); // false

echo "<br>";
echo 'I am ' . $englandCountry->defindYourSelf(); 
echo "<br>";
echo 'I am ' . $vietnamCountry->defindYourSelf(); 

?>