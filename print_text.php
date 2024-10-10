<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $printerIp = $_POST['printerIp'];
    $printerPort = $_POST['printerPort'];
    $printText = $_POST['printText'];
    $characterTable = isset($_POST['characterTable']) ? intval($_POST['characterTable']) : 0;

    try {
        $connector = new NetworkPrintConnector($printerIp, $printerPort);
        $printer = new Printer($connector);

        $printer->selectCharacterTable($characterTable); // Set character table
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("Character Table $characterTable: $printText\n");
        $printer->cut();

        $printer->close();
        echo "Printed with Character Table $characterTable.";<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $printerIp = $_POST['printerIp'];
    $printerPort = $_POST['printerPort'];
    $printText = $_POST['printText'];

    try {
        // Log connection attempt
        error_log("Attempting to connect to printer at IP: $printerIp and Port: $printerPort");

        // Connect to the printer
        $connector = new NetworkPrintConnector($printerIp, $printerPort);
        $printer = new Printer($connector);
        error_log("Successfully connected to the printer.");

        // Set character table 17 for Greek characters
        error_log("Selecting character table 17 for Greek characters.");
        $printer->selectCharacterTable(17);

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