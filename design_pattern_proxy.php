<?php 
/*
🧩 Scenario: Image Viewer with Lazy Loading (Virtual Proxy)
You are building an image viewer application where loading a full-resolution image is an expensive operation (e.g., loading from disk, downloading, or rendering). Instead of loading the full image immediately, you want to load it only when it's actually needed (i.e., when the user clicks to view it).

🏗️ Your task:
Implement the Proxy Design Pattern to:

Create an ImageInterface with a method like display().

Create a RealImage class that loads and displays the image.

Create a ProxyImage class that wraps the RealImage, but only creates/loads it when display() is called.

🧱 Structure:
plaintext
Copy
Edit
ImageInterface
   ↑
   ├── RealImage (heavy)
   └── ProxyImage (light)
✅ Requirements:
Use PHP, but feel free to use another language if you're practicing in one.

Log a message when the real image is loaded and displayed.

Log another message when the proxy is called but delays loading until needed.

Bonus: Create a small script that uses an array of ImageInterface and displays only one.

✍️ Example usage:
php
Copy
Edit
$gallery = [
    new ProxyImage("image1.jpg"),
    new ProxyImage("image2.jpg"),
    new ProxyImage("image3.jpg")
];

// Only load and display image2 when user selects it
$gallery[1]->display();
*/

interface Image {
    public function display();
}

class RealImage implements Image {
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->loadImage();
    }

    private function loadImage()
    {
        echo "Loading image: {$this->filename}\n";
    }

    public function display()
    {
        echo "Displaying image: {$this->filename}\n";
    }
}

class ProxyImage implements Image {
    private $filename;
    private $realImage;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->realImage = null; // Not loaded yet
    }

    public function display()
    {
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename);
        }
        $this->realImage->display();
    }
}

$img = new ProxyImage("cat.jpg");
echo "Proxy created\n";

// No loading yet
sleep(1);
$img->display(); // Now loads and displays

