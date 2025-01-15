# Basic Contact System

## Description
The **Basic Contact System** is a CRUD application built using the **PHP** and **CodeIgniter** framework, with **JQuery (AJAX)** functionality. This system allows users to manage their contacts efficiently while providing a seamless and interactive user experience.

## Scopes / What You Will Learn
- **Basic CRUD System Using CodeIgniter**: Learn how to implement Create, Read, Update, and Delete functionalities.
- **Single Page View CRUD**: Understand how to handle all CRUD operations within a single page using AJAX.
- **AJAX-Driven Features**:
  - Pagination
  - Search functionality
  - Add, delete, and edit contacts
- **Profile Settings**: Manage user profile settings with or without updating the password.
- **Registration Page**: Create a registration system for new users.
- **User-Specific Contacts**: Ensure that registered users can only access their own contacts.
- **Duplicate Contact Tracking**: Track and prevent duplicate contacts by comparing phone numbers.

## Plugins Added
- **JQuery**: Simplifies HTML document traversal and manipulation.
- **Parsley**: Provides front-end form validation.
- **SweetAlert 1**: Displays elegant alerts, warnings, and notifications.

## Disclaimer
- **Not for Sale**: This project is for educational purposes only. Everything is free to view.
- **Educational Use**: Intended for beginners starting development with AJAX and the CodeIgniter Framework.

## Buy Me Some Coffee ☕
If you find this project helpful, consider supporting me:
[https://paypal.me/mjpino](https://paypal.me/mjpino)

---

## Getting Started

### Prerequisites
- PHP <= 7.4
- CodeIgniter 3.x
- MySQL 5.7+
- Apache/Nginx Server

### Installation
1. Clone the repository:
   ```bash
   git clone git@github.com:spymyway6/Contact-System.git
   ```
2. Navigate to the project directory:
   ```bash
   cd Contact-System
   ```
3. Set up your database:
   - Import the SQL file located in the `db` folder into your MySQL database or add/import them manually.
     ```bash
     mysql -u yourusername -p yourpassword yourdatabase < db/basic_contact_system.sql
     ```
4. Update the `application/config/database.php` file with your database credentials.
5. Run the application:
   ```bash
   php -S localhost:8000
   ```
6. Access the system in your browser at `http://localhost:8000`.

## Contributing
Feel free to contribute to this project by submitting issues or pull requests. Contributions are always welcome!

## License
This project is open-source and available under the [MIT License](LICENSE).

---
Thank you for checking out the **Basic Contact System**! Happy coding! 🎉

