<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ .'/../vendor/autoload.php';

use JigneshSharma\New\Model\Contact; 
use JigneshSharma\New\Form\Form;

$contactModel = new Contact();

// Fetch all contacts
$contacts = $contactModel->getAll();

// Define dynamic form fields
$fieldConfigs = [
    ['type' => 'textInput', 'name' => 'name', 'label' => 'Name'],
    ['type' => 'textInput', 'name' => 'phone', 'label' => 'Phone'],
    ['type' => 'textInput', 'name' => 'email', 'label' => 'Email'],
    ['type' => 'textInput', 'name' => 'address', 'label' => 'Address'],
];

// Initialize variables for edit
$contact = null;
$isEditing = false;

// Check if the edit action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $contactId = $_GET['id'];
    $contact = $contactModel->getById($contactId);
    if ($contact) {
        $isEditing = true;
        // Pre-fill form with contact data for editing
        $fieldConfigs[0]['value'] = $contact['name'];
        $fieldConfigs[1]['value'] = $contact['phone'];
        $fieldConfigs[2]['value'] = $contact['email'];
        $fieldConfigs[3]['value'] = $contact['address'];
    }
}

// Create or edit contact based on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && $_POST['id']) {
        // Update the contact
        $contactModel->update($_POST['id'], $_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address']);
    } else {
        // Create a new contact
        $contactModel->create($_POST['name'], $_POST['phone'], $_POST['email'], $_POST['address']);
    }
    header("Location: /");
    exit;
}
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $contactModel->delete($_GET['id']);
    header("Location: /"); // Redirect back to the contact list
    exit;
}
// Create the form
$form = new Form($fieldConfigs);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Manager</title>
     <!-- import stylesheet here -->
      <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Contact Manager</h1>
        <a href="/" class="btn-add">Add New Contact</a>
        <button id="theme-toggle" class="btn-add">
            <span id="theme-icon">🌙</span> 
        </button>
        <a href="/export.php" class="btn-add">Export to CSV</a>

    </div>

        <!-- Render the form -->
        <form method="POST" action="">
            <label>Name</label>
            <input type="text" name="name" value="<?= $isEditing ? $contact['name'] : '' ?>" required>

            <label>Phone</label>
            <input type="text" name="phone" value="<?= $isEditing ? $contact['phone'] : '' ?>" required>

            <label>Email</label>
            <input type="text" name="email" value="<?= $isEditing ? $contact['email'] : '' ?>" required>

            <label>Address</label>
            <input type="text" name="address" value="<?= $isEditing ? $contact['address'] : '' ?>" required>

            <!-- Include hidden field to track if editing -->
            <?php if ($isEditing): ?>
                <input type="hidden" name="id" value="<?= $contact['id'] ?>">
            <?php endif; ?>

            <input type="submit" value="<?= $isEditing ? 'Update Contact' : 'Create Contact' ?>" class="btn">
        </form>

        <h2>Contacts List</h2> <br>
        <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search for contacts..." onkeyup="searchContacts()">
    
</div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?= $contact['name'] ?></td>
                        <td><?= $contact['phone'] ?></td>
                        <td><?= $contact['email'] ?></td>
                        <td><?= $contact['address'] ?></td>
                        <td class="action-btns">
                            <a href="?action=edit&id=<?= $contact['id'] ?>" class="btn">Edit</a>
                            <a href="?action=delete&id=<?= $contact['id'] ?>" class="btn" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
         // Select the toggle button and icon
    const themeToggleButton = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    // Check for saved preference from localStorage
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
        themeIcon.textContent = '☀️'; // Set to sun icon when dark mode is active
    } else {
        themeIcon.textContent = '🌙'; // Set to moon icon for light mode
    }

    // Add click event to the toggle button
    themeToggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');

        // Switch icons based on current theme
        if (document.body.classList.contains('dark-mode')) {
            themeIcon.textContent = '☀️'; // Switch to sun for dark mode
            localStorage.setItem('theme', 'dark'); // Save dark mode in localStorage
        } else {
            themeIcon.textContent = '🌙'; // Switch to moon for light mode
            localStorage.setItem('theme', 'light'); // Save light mode in localStorage
        }
    });
        function searchContacts() {
        var input = document.getElementById("searchInput").value.toUpperCase();
        var table = document.querySelector("table tbody");
        var tr = table.getElementsByTagName("tr");

        for (var i = 0; i < tr.length; i++) {
            var tdName = tr[i].getElementsByTagName("td")[0];
            var tdPhone = tr[i].getElementsByTagName("td")[1];
            var tdEmail = tr[i].getElementsByTagName("td")[2];
            var tdAddress = tr[i].getElementsByTagName("td")[3];

            if (tdName || tdPhone || tdEmail || tdAddress) {
                var nameValue = tdName.textContent || tdName.innerText;
                var phoneValue = tdPhone.textContent || tdPhone.innerText;
                var emailValue = tdEmail.textContent || tdEmail.innerText;
                var addressValue = tdAddress.textContent || tdAddress.innerText;

                if (nameValue.toUpperCase().indexOf(input) > -1 ||
                    phoneValue.toUpperCase().indexOf(input) > -1 ||
                    emailValue.toUpperCase().indexOf(input) > -1 ||
                    addressValue.toUpperCase().indexOf(input) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    </script>
</body>
</html>
