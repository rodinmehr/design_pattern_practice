<?php
/*
Practice Task: GUI Component Factory
Scenario
You are building a cross-platform GUI library that supports Windows and MacOS. Each platform has its own style of buttons and checkboxes.

Instead of manually checking which OS is running and creating the correct UI components, you will use the Abstract Factory Pattern to dynamically generate the appropriate components.

Your Task:
1️⃣ Create an abstract factory (GUIFactory) that defines methods for creating buttons and checkboxes.

2️⃣ Implement two concrete factories:

WindowsFactory → Creates Windows-style buttons and checkboxes.
MacFactory → Creates MacOS-style buttons and checkboxes.
3️⃣ Create abstract product interfaces:

Button → Defines common behavior for buttons.
Checkbox → Defines common behavior for checkboxes.
4️⃣ Implement concrete products:

WindowsButton, MacButton
WindowsCheckbox, MacCheckbox
5️⃣ Write a client class (Application) that asks the factory to create UI components based on the detected OS.

Expected Usage Example
After implementing the Abstract Factory pattern, your code should work like this:

php
Copy
Edit
$os = 'mac'; // Assume this is detected dynamically

if ($os === 'windows') {
    $factory = new WindowsFactory();
} else {
    $factory = new MacFactory();
}

// Creating platform-specific components
$button = $factory->createButton();
$checkbox = $factory->createCheckbox();

$button->render(); // Outputs: "Rendering a Windows/MacOS button"
$checkbox->render(); // Outputs: "Rendering a Windows/MacOS checkbox"
Bonus Challenges
✅ Extendability: Add support for another OS (e.g., Linux) without modifying existing factories.
✅ Dynamic Selection: Instead of setting $os manually, determine the OS dynamically.
✅ More Components: Add TextBox, Dropdown, etc., and update the factories accordingly.
*/

interface GUIFactory
{
    public function createButton(): Button;

    public function createCheckbox(): Checkbox;
}

class WindowsFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new WindowsButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new WindowsCheckbox();
    }
}

class MacFactory implements GUIFactory
{
    public function createButton(): Button
    {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new MacCheckbox();
    }
}

interface Button
{
    public function render(): void;
}

interface Checkbox
{
    public function render(): void;
}

class WindowsButton implements Button
{
    public function render(): void
    {
        echo "Rendering a Windows button\n";
    }
}

class WindowsCheckbox implements Checkbox
{
    public function render(): void
    {
        echo "Rendering a Windows checkbox\n";
    }
}

class MacButton implements Button
{
    public function render(): void
    {
        echo "Rendering a MacOS button\n";
    }
}

class MacCheckbox implements Checkbox
{
    public function render(): void
    {
        echo "Rendering a MacOS checkbox\n";
    }
}

// // Client code
// function clientCode(GUIFactory $factory)
// {
//     $button = $factory->createButton();
//     $checkbox = $factory->createCheckbox();

//     $button->render();
//     $checkbox->render();
// }

// clientCode(new MacFactory());
// clientCode(new WindowsFactory());

class Application
{
    private $button;
    private $checkbox;

    public function __construct(GUIFactory $factory)
    {
        $this->button = $factory->createButton();
        $this->checkbox = $factory->createCheckbox();
    }

    public function run()
    {
        $this->button->render();
        $this->checkbox->render();
    }
}

$application = new Application(new MacFactory());
$application->run();
