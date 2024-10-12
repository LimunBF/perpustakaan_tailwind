# Simple Library Management System

This is a basic Library Management System built using PHP, HTML, JavaScript, and MySQL. The system allows users to manage library operations such as adding, viewing, updating, and deleting books and users. The project includes basic user authentication and responsive design elements with Bootstrap and Tailwind CSS.

## Features

- **User Management:** 
  - Admin can add, update, view, and delete user records.
  - Stores user data such as name, email, telephone, and gender.

- **Book Management:** 
  - Add, update, view, and delete books from the library catalog.
  - Includes book information like title, author, and publication year.

- **Authentication:** 
  - Simple login system for admin access using PHP and MySQL.
  - Redirect to home page upon successful login.

## Technology Stack

- **Frontend:**
  - HTML for structure.
  - Tailwind CSS and Bootstrap for styling and responsive design.
  - JavaScript for client-side validation and interaction.

- **Backend:**
  - PHP for server-side scripting.
  - MySQL as the database management system.

## File Structure

- `index.php`: Homepage and login form for the system.
- `Components/Php/Admin`: Admin panel for managing users and books.
- `Components/Php/User`: User-related functionalities.
- `Components/Connection/DBConnection.php`: Database connection file.
- `Components/Css/`: Custom CSS file for the project.

## Database Structure

### Admin Table
| Column     | Type           | Description                 |
|------------|----------------|-----------------------------|
| id         | bigint(20)      | Auto Increment, Primary Key |
| username   | varchar(40)     | Admin username              |
| password   | varchar(40)     | Admin password              |

### Admins Table
| Column     | Type           | Description            |
|------------|----------------|------------------------|
| username   | varchar(40)     | Admin username (Not NULL) |
| password   | varchar(40)     | Admin password (Not NULL) |

### Books Table
| Column      | Type           | Description                |
|-------------|----------------|----------------------------|
| ISBN        | bigint(20)      | Book's ISBN number         |
| BOOK_ID     | bigint(20)      | Unique book identifier     |
| GENRE       | text            | Genre of the book          |
| JUDUL       | text            | Title of the book          |
| PENULIS     | text            | Author of the book         |
| PUBLISHER   | text            | Publisher's name           |
| TAHUN       | bigint(20)      | Year of publication        |
| JUMLAH      | bigint(20)      | Number of available copies |


## Setup Instructions

1. Clone the repository to your local machine:
   ```bash
    git clone https://github.com/your-repo/l-system.git](https://github.com/LimunBF/perpustakaan_tailwind.git
