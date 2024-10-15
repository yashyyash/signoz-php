require 'vendor/autoload.php';

use SigNoz\SigNoz;

SigNoz::init('http://<SIGNOZ_SERVER>:4317'); // Replace with your SigNoz server URL

// Define a function to get the greeting message
function getGreeting(): string {
    return "Hello, World!";
}

// Start a new trace
$trace = SigNoz::startTrace('greeting');

// Using a match expression to choose a message based on a condition
$condition = true;
$message = match ($condition) {
    true => "Welcome to PHP 8.1!",
    false => "Goodbye!",
};

// End the trace
SigNoz::endTrace($trace);

// Log a message
SigNoz::log('info', 'Greeting displayed', ['message' => $message]);

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
