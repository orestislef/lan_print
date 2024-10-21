<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//http://localhost:8080/print/api/printer_status.php?ip=192.168.24.60
// Check if the 'ip' parameter is provided in the GET request
if (isset($_GET['ip'])) {
    $ip = $_GET['ip'];

	// Set the content type to JSON
    header('Content-Type: application/json');
	
    // Ensure the provided IP is safe
    if (filter_var($ip, FILTER_VALIDATE_IP)) {

        // Use the full path to the Python executable
		$python_path = "C://Users/billy/AppData/Local/Programs/Python/Python39/python.exe";

        $command = escapeshellcmd($python_path . " C:/xampp/htdocs/print/api/printer_status.py " . escapeshellarg($ip));

        // Execute the Python script and capture the output (including errors)
        $output = shell_exec($command . " 2>&1");

        // Check if the output is empty or there is an error
        if (empty($output)) {
            echo json_encode(['error' => 'No output or command failed']);
        } else {            
            // Output the JSON result from the Python script
            echo $output;
        }
    } else {
        // Invalid IP address
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['error' => 'Invalid IP address']);
    }
} else {
    // No IP provided
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'No IP address provided']);
}
