<?php
/*
🎯 Scenario: Coffee Shop Order System
You’re building a system to calculate the cost of coffee drinks in a coffee shop. The base product is a simple coffee, and customers can add optional ingredients (decorators) like milk, caramel, whipped cream, etc.

Each decorator adds a cost and description to the base drink.

🧱 Core Requirements
A base Coffee interface with a cost() method and description().

A SimpleCoffee class implementing the interface.

Several decorators:

MilkDecorator

CaramelDecorator

WhippedCreamDecorator

Each decorator should:

Extend the base Coffee interface.

Take a Coffee object in its constructor.

Add its own cost to the base coffee.

🧪 Sample Usage
php
Copy
Edit
$coffee = new SimpleCoffee(); // base coffee
$coffee = new MilkDecorator($coffee); // add milk
$coffee = new CaramelDecorator($coffee); // add caramel

echo $coffee->getDescription(); // Simple Coffee, Milk, Caramel
echo $coffee->cost(); // 5.00 (base) + 1.00 (milk) + 1.50 (caramel)
🧠 Optional Challenges
Add size variations (small, medium, large).

Add a SugarDecorator that doesn’t change cost but affects description.

Make it work with Laravel service container binding if you’re into that.
*/

interface Coffee
{
    public function cost();
    public function getDescription();
}

class SimpleCoffee implements Coffee
{
    private $cost = 5.00;
    private $description = "Simple Coffee";

    public function cost()
    {
        return $this->cost;
    }

    public function getDescription()
    {
        return $this->description;
    }
}

class MilkDecorator implements Coffee
{
    private $coffee;
    private $cost = 0.50;
    private $description = "Milk";

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function cost()
    {
        return $this->coffee->cost() + $this->cost;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", " . $this->description;
    }
}

class CaramelDecorator implements Coffee
{
    private $coffee;
    private $cost = 1.00;
    private $description = "Caramel";

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function cost()
    {
        return $this->coffee->cost() + $this->cost;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", " . $this->description;
    }
}

class WhippedCreamDecorator implements Coffee
{
    private $coffee;
    private $cost = 1.50;
    private $description = "Whipped Cream";

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function cost()
    {
        return $this->coffee->cost() + $this->cost;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", " . $this->description;
    }
}

class SugarDecorator implements Coffee
{
    private $coffee;
    private $description = "Sugar";

    public function __construct(Coffee $coffee)
    {
        $this->coffee = $coffee;
    }

    public function cost()
    {
        return $this->coffee->cost();
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", " . $this->description;
    }
}

$simple = new SimpleCoffee();
$milk = new MilkDecorator($simple);
$caramel = new CaramelDecorator($milk);
$whipped = new WhippedCreamDecorator($caramel);

$sugar = new SugarDecorator($whipped);

echo $whipped->getDescription() . "\n";
echo $whipped->cost() . "\n";

echo "\n";
echo $sugar->getDescription() . "\n";
echo $sugar->cost() . "\n";