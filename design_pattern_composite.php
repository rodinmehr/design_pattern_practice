<?php
/*
✅ Practice Idea: File System Structure
You can model a simplified file system with File and Folder using the Composite Pattern.

Common Interface
FileSystemItem (interface/abstract class)

Method: display(indentLevel)

Both File and Folder implement this

Leaf: File
Has a name

Implements display() to print its name

Composite: Folder
Has a name

Contains many FileSystemItems (files or folders)

display() calls display() on its children recursively

🔧 Your Task
Create a FileSystemItem interface or abstract class.

Create a File class that implements the interface.

Create a Folder class that can hold both Files and Folders.

Create a tree of folders and files and display the full structure.

🧪 Bonus Challenges
Add a size() method to compute total size recursively.

Add permissions (e.g. read/write flags).

Allow renaming or deleting children.

*/

abstract class FileSystemItem
{
    abstract public function display();
    abstract public function getSize();
    abstract public function getPermissions();
    abstract public function getChildSize();
    abstract public function hasChild();
}

class File extends FileSystemItem
{

    private $name;
    private $size;
    private $permissions;

    public function __construct($name, $size, $permissions)
    {
        $this->name = $name;
        $this->size = $size;
        $this->permissions = $permissions;
    }

    public function display()
    {
        echo $this->name . "\n";
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getPermissions()
    {
        echo $this->permissions . "\n";
    }

    public function getChildSize()
    {
        return 1;
    }

    public function hasChild()
    {
        return false;
    }
}

class Folder extends FileSystemItem
{
    private $name;
    private $size;
    private $permissions;
    private $parents;

    protected $children = [];

    public function __construct($name, $size, $permissions)
    {
        $this->name = $name;
        $this->size = $size;
        $this->permissions = $permissions;
        $this->parents = 0;

    }

    public function add(FileSystemItem $item)
    {
        $this->children[] = $item;
        if($item->hasChild()) {
            $this->parents++;
        }
    }

    public function display()
    {
        echo "Folder '" . $this->name . "':\n";
        foreach ($this->children as $child) {
            if($child->hasChild()) {
                echo str_repeat("\t", $this->parents) . "  - ";
                $child->display();
            } else {
                echo str_repeat("\t", $this->parents) . "  - ";
                $child->display();
            }
        }
    }

    public function getSize()
    {
        $size = $this->size;
        foreach ($this->children as $child) {
            $size += $child->getSize();
        }
        return $size;
    }

    public function getPermissions()
    {
        echo $this->permissions . "\n";
        foreach ($this->children as $child) {
            if($child->hasChild()) {
                echo str_repeat("\t", $this->parents) . "  - ";
                // echo str_repeat("\t", $this->getChildSize()) . "  - ";
                $child->getPermissions();
            } else {
                echo str_repeat("\t", $this->parents) . "  - ";
                // echo str_repeat("\t", $this->getChildSize()) . "  - ";
                $child->getPermissions();
            }
        }
    }

    public function getChildSize()
    {
        $size = 0;
        foreach ($this->children as $child) {
            $size += $child->getChildSize();
        }
        return $size;
    }

    public function hasChild()
    {
        return !empty($this->children);
    }
}

function clientCode(FileSystemItem $item)
{
    $item->display();
    echo "Total size: " . $item->getSize() . "\n";
    echo "Permissions: \n";
    $item->getPermissions();
    echo "\n";
    echo "Child size: " . $item->getChildSize() . "\n";
}

$file1 = new File("file1.txt", 1, '-r-');
$file2 = new File("file2.txt", 1, '-rw');
$folder1 = new Folder("folder1", 2, 'xrw');
$folder2 = new Folder("folder2", 2, 'x-w');

$folder1->add($file1);
$folder1->add($folder2);
$folder2->add($file2);

clientCode($folder1);
