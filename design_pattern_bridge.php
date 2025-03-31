<?php
/*
Practice Task: Implement a Notification System Using the Bridge Pattern
Scenario:
You are building a notification system for a multi-platform application. The system needs to send notifications via Email, SMS, and Push Notifications. Also, notifications can be of different types, such as Order Notifications, Alerts, and Promotions.

Instead of tightly coupling the notification types with the sending methods, you will use the Bridge Pattern to separate them.

Your Task
1️⃣ Create a NotificationSender interface (Bridge Implementor) that has a method like send($message).

2️⃣ Implement concrete sender classes:

EmailSender → Sends notifications via Email.

SMSSender → Sends notifications via SMS.

PushSender → Sends notifications via Push Notification.

3️⃣ Create an abstract Notification class (Abstraction) that will use a NotificationSender to send messages.

4️⃣ Implement concrete notification types:

OrderNotification → Sends order-related messages.

AlertNotification → Sends urgent alerts.

PromotionNotification → Sends marketing promotions.

5️⃣ Test your bridge implementation by sending different types of notifications via different sending methods.

Expected Usage Example
Once you implement the Bridge Pattern correctly, your code should work like this:

php
Copy
Edit
$orderNotification = new OrderNotification(new EmailSender());
$orderNotification->sendNotification("Your order has been shipped!");

$alertNotification = new AlertNotification(new SMSSender());
$alertNotification->sendNotification("Your account login was detected from a new device.");

$promotionNotification = new PromotionNotification(new PushSender());
$promotionNotification->sendNotification("Limited-time discount: Get 20% off!");
✅ Expected Output:

pgsql
Copy
Edit
Sending Email: Your order has been shipped!
Sending SMS: Your account login was detected from a new device.
Sending Push Notification: Limited-time discount: Get 20% off!
Bonus Challenges
✅ Extendability: Add another notification type (e.g., SystemUpdateNotification) without modifying existing code.
✅ New Sending Method: Add a WhatsAppSender that sends messages via WhatsApp.
✅ Multi-Sender Notifications: Allow a notification to be sent via multiple methods at once.

*/

abstract class NotificationType
{
    protected $sender;

    public function __construct(NotificationSender $sender)
    {
        $this->sender = $sender;
    }

    public abstract function sendNotification($message);
}

class OrderNotification extends NotificationType
{
    public function __construct(NotificationSender $sender)
    {
        parent::__construct($sender);
    }

    public function sendNotification($message)
    {
        echo "Order Notificaiton:\n";
        $this->sender->send($message);
    }
}

class AlertNotification extends NotificationType
{
    public function __construct(NotificationSender $sender)
    {
        parent::__construct($sender);
    }

    public function sendNotification($message)
    {
        echo "Alert Notification:\n";
        $this->sender->send($message);
    }
}

class PromotionNotification extends NotificationType
{
    public function __construct(NotificationSender $sender)
    {
        parent::__construct($sender);
    }

    public function sendNotification($message)
    {
        echo "promotion Notification:\n";
        $this->sender->send($message);
    }
}

interface NotificationSender
{
    public function send($message);
}

class EmailSender implements NotificationSender
{
    public function send($message)
    {
        echo "Sending via Email: $message\n";
    }
}

class SMSSender implements NotificationSender
{
    public function send($message)
    {
        echo "Sending via SMS: $message\n";
    }
}

class PushSender implements NotificationSender
{
    public function send($message)
    {
        echo "Sending via Push: $message\n";
    }
}

function clientCode(NotificationType $type, $message)
{
    $type->sendNotification($message);
}

$orderNotification = new OrderNotification(new EmailSender());
clientCode($orderNotification, "Your order has been shipped!");

$alertNotification = new AlertNotification(new SMSSender());
clientCode($alertNotification, "Your account login was detected from a new device.");

$promotionNotification = new PromotionNotification(new PushSender());
clientCode($promotionNotification, "Limited-time discount: Get 20% off!");