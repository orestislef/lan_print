<?php
require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $printerIp = $_POST['printerIp'];
    $printerPort = $_POST['printerPort'];
    $printText = $_POST['printText'];

    try {
        $connector = new NetworkPrintConnector($printerIp, $printerPort);
        $printer = new Printer($connector);
        
        $printer->selectCharacterTable(42); // Set encoding for Greek characters (if supported)
        
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text($printText . "\n");
        $printer->cut();
        
        $printer->close();

        echo "Text printed successfully.";
    } catch (Exception $e) {
        echo "Couldn't print to this printer: " . $e->getMessage();
    }
}
?>
