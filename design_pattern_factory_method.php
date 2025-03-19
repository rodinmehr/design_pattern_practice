<?php
/*
Practice Task: Implement a Notification System Using Factory Method Pattern
Scenario:
You are building a notification system for a web application. The application should be able to send Email, SMS, and Push Notifications.

Instead of directly instantiating these notification types using new EmailNotification(), new SMSNotification(), etc., you should use the Factory Method pattern to create the notifications dynamically.

Your Task:
Create an abstract class/interface called Notification with a method send($message).
Implement three concrete classes:
EmailNotification → Sends an email.
SMSNotification → Sends an SMS.
PushNotification → Sends a push notification.
Create a Factory Method class (NotificationFactory) that will generate the appropriate notification type based on user input.
Write a test case where the system sends notifications of different types using the factory.
Expected Usage Example
Your goal is to make sure this code works after implementing the Factory Method pattern:

php
CopyEdit
$factory = new NotificationFactory();

$email = $factory->createNotification("email");
$email->send("Hello via Email!");

$sms = $factory->createNotification("sms");
$sms->send("Hello via SMS!");

$push = $factory->createNotification("push");
$push->send("Hello via Push Notification!");
Bonus Challenges
✅ Validation: Ensure the factory method throws an exception if an invalid notification type is provided.
✅ Extendability: Add a new notification type later (e.g., WhatsAppNotification) without modifying existing factory logic.
✅ User Input: Accept user input (from a form or CLI) to dynamically choose the notification type.
*/
