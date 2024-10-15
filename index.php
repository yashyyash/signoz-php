<?php

// Define a function to get the greeting message
function getGreeting(): string {
    return "Hello, World!";
}

// Using a match expression to choose a message based on a condition
$condition = true;
$message = match ($condition) {
    true => "Welcome to PHP 8.1!",
    false => "Goodbye!",
};

// Start the HTML output
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello World in PHP 8.1</title>
</head>
<body>
    <h1><?php echo getGreeting(); ?></h1>
    <p><?php echo $message; ?></p>
    <p>This is a basic PHP script that displays messages using PHP 8.1 features.</p>
</body>
</html>
