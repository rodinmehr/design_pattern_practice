<?php
/*
Practice Task: Build a Pizza Order System
Scenario:
You are designing a pizza ordering system where customers can create a customized pizza. The pizza may have optional ingredients like extra cheese, pepperoni, mushrooms, etc. Instead of using a constructor with too many parameters, use the Builder Pattern to construct the pizza.

Your Task:
Create a Pizza class that has attributes like:

size (small, medium, large)
cheese (boolean)
pepperoni (boolean)
mushrooms (boolean)
olives (boolean)
Create a PizzaBuilder class that allows:

Setting the size
Adding cheese
Adding pepperoni
Adding mushrooms
Adding olives
A method build() to return the final Pizza object
Write a test case where a customer orders a custom pizza.

Example: A large pizza with cheese, mushrooms, and olives, but no pepperoni.
Expected Usage Example
After implementing the Builder Pattern, your code should work like this:

php
Copy
Edit
$builder = new PizzaBuilder();
$pizza = $builder->setSize('large')
                 ->addCheese()
                 ->addMushrooms()
                 ->addOlives()
                 ->build();

$pizza->display(); 
// Expected Output: "Pizza (Size: Large, Cheese: Yes, Mushrooms: Yes, Olives: Yes, Pepperoni: No)"
Bonus Challenges
✅ Fluent Interface: Ensure the builder supports method chaining.
✅ Default Values: If a customer doesn’t specify an option, it should have a default value (e.g., pepperoni = false).
✅ Extendability: Later, add more ingredients like onions, sausage, or BBQ sauce without modifying the Pizza class.
*/

interface PizzaBuilderInterface
{
    public function setSize(string $size): PizzaBuilderInterface;

    public function addCheese(): PizzaBuilderInterface;

    public function addPepperoni(): PizzaBuilderInterface;

    public function addMushrooms(): PizzaBuilderInterface;

    public function addOlives(): PizzaBuilderInterface;

    public function build(): Pizza;
}

class PizzaBuilder implements PizzaBuilderInterface
{
    private $pizza;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->pizza = new Pizza();
    }

    public function setSize(string $size): PizzaBuilderInterface
    {
        $this->pizza->size = $size;
        return $this;
    }

    public function addCheese(): PizzaBuilderInterface
    {
        $this->pizza->cheese = true;
        return $this;
    }

    public function addPepperoni(): PizzaBuilderInterface
    {
        $this->pizza->pepperoni = true;
        return $this;
    }

    public function addMushrooms(): PizzaBuilderInterface
    {
        $this->pizza->mushrooms = true;
        return $this;
    }

    public function addOlives(): PizzaBuilderInterface
    {
        $this->pizza->olives = true;
        return $this;
    }

    public function build(): Pizza
    {
        $pizza = $this->pizza;
        $this->reset();
        return $pizza;
    }
}

class Pizza
{
    public $size;
    public $cheese = false;
    public $pepperoni = false;
    public $mushrooms = false;
    public $olives = false;

    public function display()
    {
        // Expected Output: "Pizza (Size: Large, Cheese: Yes, Mushrooms: Yes, Olives: Yes, Pepperoni: No)"
        echo "Pizza (Size: {$this->size}, Cheese: " . ($this->cheese ? 'Yes' : 'No') . ", Mushrooms: " . ($this->mushrooms ? 'Yes' : 'No') . ", Olives: " . ($this->olives ? 'Yes' : 'No') . ", Pepperoni: " . ($this->pepperoni ? 'Yes' : 'No') . ")\n";
    }
}

class Chef
{

    private $pizzaBuilder;

    public function setPizzaBuilder(PizzaBuilderInterface $pizzaBuilder)
    {
        $this->pizzaBuilder = $pizzaBuilder;
    }

    public function makeLargePizza()
    {
        $this->pizzaBuilder->setSize('large')
            ->addCheese()
            ->addMushrooms()
            ->addOlives();
    }

    public function makeSmallPizza()
    {
        $this->pizzaBuilder->setSize('small')
            ->addCheese()
            ->addMushrooms()
            ->addOlives();
    }

    public function makeLargePepperoniPizza()
    {
        $this->pizzaBuilder->setSize('large')
            ->addCheese()
            ->addPepperoni();
    }
}
// $builder = new PizzaBuilder();
// $pizza = $builder->setSize('large')
//     ->addCheese()
//     ->addMushrooms()
//     ->addOlives()
//     ->build();

// $pizza->display();

function clientCode(Chef $chef)
{
    $builder = new PizzaBuilder();
    $chef->setPizzaBuilder($builder);

    echo "Making a large pizza:\n";
    $chef->makeLargePizza();
    $pizza = $builder->build();
    $pizza->display();

    echo "Making a small pizza:\n";
    $chef->makeSmallPizza();
    $pizza = $builder->build();
    $pizza->display();

    echo "Making a large pepperoni pizza:\n";
    $chef->makeLargePepperoniPizza();
    $pizza = $builder->build();
    $pizza->display();
}

$chef = new Chef();
clientCode($chef);
