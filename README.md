# Advanced Contact Management System

## Project Overview

The Advanced Contact Management System is a PHP-based web application for managing contacts. It supports functionalities such as adding, editing, deleting, sorting, searching, and exporting contacts. The application is designed using a clean MVC architecture with a focus on maintainability and extensibility.

## Features

- **Contact Management**: Add, edit, and delete contacts.
- **Sorting**: Sort contacts by Name, Phone, Email, or Address.
- **Searching**: Search for contacts by Name, Phone, Email, or Address.
- **Dark Mode**: Toggle between light and dark themes.
- **Export**: Export contacts to CSV.
- **Responsive Design**: Adaptable for mobile and tablet views.

## Architecture and Patterns

- **MVC Architecture**: The system follows the Model-View-Controller (MVC) pattern.
  - **Model**: Manages the data and business logic (e.g., `Contact` class).
  - **View**: Handles the presentation layer (e.g., HTML and CSS in views).
  - **Controller**: Manages user input and interacts with the model (e.g., handling form submissions).

- **Factory Pattern**: Used for database connection management (e.g., `DatabaseFactory` class).

- **Form Handling**: Abstract class and derived classes for rendering different types of form fields (e.g., `TextInput`, `CheckboxField`).

## Installation Instructions

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer

### Steps

1. **Clone the Repository**

   ```bash
   git clonehttps://github.com/jigneshsharma123/Contact_mangement

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Configure Database**

   - I have used pdo(PHP DATA OBJECT) for database connection.
   - you don't need to configuration db just follow the steps below.

4. **create a database with name contact_manager**
     
     and then create a table with name contact with the following 
     columns.

```code ```
    CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    email VARCHAR(255),
    address TEXT
);

5. ** Move to the DatabaseFactory.php file and change the database connection details.**

6. **Generate the vendor file**

   ```bash
   composer dump-autoload
   ```

7. **Run the Application**

   - Open your web browser and navigate to the URL where your application is hosted.
   - You should see the contact management system interface.



 ***output Video Link*** 

  https://youtu.be/gjjAcNjIslo

  move to the 04:05 timeline to see the output. 
  rest of the video about explaining the code. 