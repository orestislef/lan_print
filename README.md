Here’s an updated `README.md` file without the image handling feature:

---

# LAN Printer Text Printing with PHP

This project allows you to send text to an ESC/POS-compatible LAN printer over a network using [escpos-php](https://github.com/mike42/escpos-php). It includes an HTML form where users can enter text and specify the printer's IP address and port for printing.

## Features

- **Print text** to a LAN-connected thermal or ESC/POS-compatible printer.
- **Greek character support** for printing in Greek.
- **XAMPP compatibility** for local development on Windows.

## Requirements

- **PHP** (compatible with `escpos-php`)
- **XAMPP** for Windows
- **ESC/POS-Compatible Printer** connected over LAN

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
```

### 2. Install escpos-php with Composer

If you don’t have Composer installed, download it from [https://getcomposer.org](https://getcomposer.org).

```bash
composer require mike42/escpos-php
```

## Configuration

### XAMPP Setup

1. Make sure XAMPP is installed and running on your Windows system.
2. Place the project folder in the `htdocs` directory of your XAMPP installation (e.g., `C:\xampp\htdocs\your-repo-name`).

### Greek Character Support

In `print_text.php`, the line `$printer->selectCharacterTable(18);` is used to support Greek characters if your printer supports the CP737 code page.

## Usage

### Running the Application

1. Open XAMPP and start the Apache server.
2. Open `http://localhost/your-repo-name/print_form.html` in your browser.

### Using the HTML Form

1. Enter the **Printer IP Address** and **Port** in the form.
2. Input the **Text to Print**.
3. Click **Print**.

The form will display an alert with a success or error message after submission.

## Project Structure

- **print_form.html** - The HTML form for user input.
- **print_text.php** - Handles the form submission, connects to the printer, and sends the text for printing.

## Example

To print using the IP `192.168.24.60` and port `9100`, ensure your printer is set up correctly with those details.

## Troubleshooting

### Common Issues

- **Greek characters not displaying correctly**: Ensure your printer supports CP737 or another code page with Greek character support.
- **Cannot connect to printer**: Verify the IP and port are correct, and the printer is accessible over the network.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---
