<?php
require __DIR__ .'/../vendor/autoload.php'; // Adjust the path based on your folder structure
use JigneshSharma\New\Model\Contact; // Import your contact model

// Create the Contact model instance
$contactModel = new Contact();

// Fetch all contacts from the database
$contacts = $contactModel->getAll();

// Generate the current date in YYYY-MM-DD format
$date = date('Y-m-d');

// Set headers to indicate a CSV file download with dynamic filename
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=contacts_$date.csv");

// Open the output stream
$output = fopen('php://output', 'w');

// Write the header row for the CSV
fputcsv($output, ['Name', 'Phone', 'Email', 'Address']);

// Loop through the contacts and write them as rows in the CSV
foreach ($contacts as $contact) {
    fputcsv($output, [$contact['name'], $contact['phone'], $contact['email'], $contact['address']]);
}

// Close the output stream
fclose($output);
exit;
