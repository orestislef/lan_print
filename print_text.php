<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $printerIp = $_POST['printerIp'];
    $printerPort = $_POST['printerPort'];
    $printText = $_POST['printText'];
    $characterTable = $_POST['characterTable'];

    try {
        // Log connection attempt
        error_log("Attempting to connect to printer at IP: $printerIp and Port: $printerPort");

        // Connect to the printer
        $connector = new NetworkPrintConnector($printerIp, $printerPort);
        $printer = new Printer($connector);
        error_log("Successfully connected to the printer.");

        // Set character table based on user input
        error_log("Selecting character table $characterTable for custom characters.");
        $printer->selectCharacterTable((int)$characterTable);

        // Set justification to center
        $printer->setJustification(Printer::JUSTIFY_CENTER);

        // Convert text encoding to Windows-1253 for Greek and Euro symbol support
        error_log("Converting text encoding from UTF-8 to Windows-1253.");
        $encodedText = iconv("UTF-8", "Windows-1253//IGNORE", $printText);
        if ($encodedText === false) {
            throw new Exception("Text encoding conversion failed.");
        }
        error_log("Text encoding conversion completed: $encodedText");

        // Print the text
        error_log("Printing the text.");
        $printer->text($encodedText . "\n");

        // Cut the paper
        error_log("Cutting the paper.");
        $printer->cut();

        // Close the printer connection
        error_log("Closing printer connection.");
        $printer->close();

        echo "Text printed successfully.";
        error_log("Text printed successfully.");

    } catch (Exception $e) {
        $errorMessage = "Couldn't print to this printer: " . $e->getMessage();
        echo $errorMessage;
        error_log($errorMessage);
    }
}
?>
