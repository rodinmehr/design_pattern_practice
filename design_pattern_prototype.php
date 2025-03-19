<?php
/*
Practice Task: Document Cloning System
Scenario:
You are building a document management system, where users can create different types of documents (e.g., Reports, Invoices, Contracts). Instead of creating each document from scratch, users should be able to clone an existing document and modify only the necessary details.

Your Task:
1️⃣ Create an abstract Document class with:

A title and content.
A clone() method that allows creating a copy of a document.
2️⃣ Implement concrete document types:

ReportDocument
InvoiceDocument
ContractDocument
3️⃣ Demonstrate cloning:

Create a ReportDocument with sample content.
Clone it and modify the title.
Print both documents to show they are separate objects but share the same structure.
Expected Usage Example
After implementing the Prototype Pattern, your code should work like this:

php
Copy
Edit
$original = new ReportDocument();
$original->setTitle("Q1 Sales Report");
$original->setContent("This report contains Q1 sales data.");

$cloned = $original->clone();
$cloned->setTitle("Q2 Sales Report"); // Only changing the title

$original->display();
$cloned->display();
Expected Output:

makefile
Copy
Edit
Document: Q1 Sales Report  
Content: This report contains Q1 sales data.  

Document: Q2 Sales Report  
Content: This report contains Q1 sales data.  
Bonus Challenges
✅ Deep Cloning: Ensure that the clone is a deep copy, meaning modifying the cloned document does not affect the original.
✅ Prototype Registry: Create a DocumentPrototypeRegistry that stores predefined document templates.
✅ More Document Types: Add more document types like ProposalDocument, PresentationDocument, etc.
*/

abstract class Document
{
    protected $title;
    protected $content;
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function display()
    {
        echo "Document: " . $this->title . "\nContent: " . $this->content . "\n";
    }

    abstract function copy();
}

class ReportDocument extends Document
{
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function copy()
    {
        return clone $this;
    }
}

class InvoiceDocument extends Document
{
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function copy()
    {
        return clone $this;
    }
}

class ContractDocument extends Document
{
    public function __construct(string $title, string $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function copy()
    {
        return clone $this;
    }
}

$original = new ReportDocument("Original Report", "This is the original report");
$cloned = $original->copy();
$cloned->setTitle("Cloned Report");
$cloned->setContent("This is the cloned report");
$original->display();
$cloned->display();
