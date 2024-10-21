```markdown
# Printer Status Dashboard

This project is a simple web-based dashboard to fetch and display the status of a printer via a PHP API. The dashboard supports **English** and **Greek** languages, with an automatic refresh every 5 seconds to update the printer status in real-time.

## Features

- **Real-Time Status**: The dashboard automatically fetches and updates the printer status every 5 seconds.
- **Language Switching**: You can switch between English and Greek by clicking the corresponding buttons.
- **Responsive Design**: The interface is mobile-friendly and adjusts to different screen sizes.
- **Dynamic Status Table**: The status of the printer (such as "Cover Is Open", "Paper End", etc.) is displayed with a circle indicator, and descriptions are translated based on the selected language.

## Technology Stack

- **HTML/CSS**: For the structure and styling of the dashboard.
- **JavaScript (Fetch API)**: Used to fetch printer status from the PHP API.
- **PHP**: The backend API that fetches the printer status from the device.
- **JSON**: The response format used by the PHP API to return the printer status.

## Getting Started

### Prerequisites

To run this project, you will need:

- **XAMPP** or any local server environment with PHP support.
- A printer that responds to status queries at a specific IP address (e.g., `192.168.24.60`).
- Basic knowledge of HTML, CSS, and JavaScript is helpful.

### Installation and Setup

1. **Download the Project Files**:
   - Save the provided `index.html` file and the PHP API file (`printer_status.php`) into your local server's web directory.
   - For XAMPP, you can place them inside the `htdocs` folder.

2. **Set Up the PHP API**:
   - Ensure that the `printer_status.php` file is located at `http://localhost:8080/print/api/printer_status.php`.
   - The PHP API is responsible for fetching the printer status using `curl`.

3. **Run the Web Page**:
   - Open the `index.html` file in a browser. By default, the IP address field will be pre-filled with `192.168.24.60`. You can modify the IP address in the input field as needed.

### How to Use

1. **Enter the Printer IP Address**: By default, the IP address is set to `192.168.24.60`. You can change this to the actual IP of your printer in the input field.
   
2. **Check Status**:
   - Press the "Check Status" button to manually fetch the printer status.
   - The page will automatically refresh the status every 5 seconds.

3. **Switch Languages**:
   - Click the **English** or **Ελληνικά** button to switch the language between English and Greek.
   - The table headers and the status descriptions will be translated dynamically based on your selection.

### Folder Structure

```
project-folder/
│
├── index.html            # Main HTML file with the dashboard interface
├── print/
│   └── api/
│       └── printer_status.php  # PHP API for fetching printer status
└── README.md             # This documentation file
```

### Example JSON Response

The PHP API returns the following example JSON format:

```json
{
    "Cover Is Open": "No",
    "Cutter Error": "No",
    "Paper End": "No",
    "Paper Near End": "No",
    "Printer Off-Line": "No"
}
```

### Language Switching

- **English**: Table headers and status descriptions are displayed in English.
- **Greek**: By clicking the Greek button, the table headers and descriptions are translated into Greek.

Example English-to-Greek Translation:

| English               | Greek                       |
|-----------------------|-----------------------------|
| Cover Is Open         | Το Κάλυμμα Είναι Ανοιχτό     |
| Cutter Error          | Σφάλμα Κόφτη                |
| Paper End             | Τέλος Χαρτιού               |
| Paper Near End        | Λήξη Χαρτιού Κοντά          |
| Printer Off-Line      | Ο Εκτυπωτής Είναι Εκτός Λειτουργίας |

### License

This project is open-source and can be modified freely.

---

### Author

- **Orestis Lef** - [GitHub Profile](https://github.com/orestislef)
```
