<?php
/*
Practice Task: Implement a Logger Using the Singleton Pattern
Scenario:
You are building a logging system for an application. The system needs a single instance of a Logger to write logs to a file. Using the Singleton Pattern, ensure that:

Only one instance of the Logger exists.
The Logger writes logs to a file.
The Logger can be accessed from anywhere in the application.
Your Task
1️⃣ Create a Logger class that:

Implements the Singleton Pattern.
Has a log($message) method to write logs to a file.
Prevents direct instantiation (__construct should be private).
Provides a getInstance() method to return the single instance.
2️⃣ Test the Singleton by:

Getting the Logger instance multiple times.
Logging messages from different parts of the application.
Ensuring all logs are written by the same Logger instance.
Expected Usage Example
Once you implement the Singleton Pattern correctly, your code should work like this:

php
Copy
Edit
$logger1 = Logger::getInstance();
$logger1->log("User logged in.");

$logger2 = Logger::getInstance();
$logger2->log("User updated profile.");

if ($logger1 === $logger2) {
    echo "Logger is a Singleton!";
}
✅ Expected Output in app.log:

pgsql
Copy
Edit
[2024-03-29 10:00:00] User logged in.
[2024-03-29 10:02:00] User updated profile.
✅ Expected Console Output:

csharp
Copy
Edit
Logger is a Singleton!
Bonus Challenges
✅ Thread Safety: Ensure the Singleton works in multi-threaded environments.
✅ Log Formatting: Include timestamps and log levels (INFO, ERROR, DEBUG).
✅ File Rotation: Automatically create a new log file when it reaches a certain size.
*/

class Logger
{
    private static $instance;

    private function __construct()
    {
        $date = date('Y-m-d H:i:s');
        echo $date . " Logger initialized.\n";
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    public function log($message)
    {
        $date = date('Y-m-d H:i:s');
        echo $date . " " . $message;
    }
}

function clientCode()
{
    $logger1 = Logger::getInstance();
    $logger1->log("User logged in.\n");

    $logger2 = Logger::getInstance();
    $logger2->log("User updated profile.\n");

    if ($logger1 === $logger2) {
        echo "Logger is a Singleton!\n";
    }
}

clientCode();
