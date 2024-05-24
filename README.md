# Electronic-Shop-ERP
ERP system for electronics shop
# Electronics Shop ERP System

## Overview

The Electronics Shop ERP System is a comprehensive solution designed to manage the various aspects of an electronics shop, including inventory management, invoicing, customer management, supplier management, and report generation. This system is built using PHP and MySQL, providing a user-friendly web interface for efficient shop operations.

## Features

- **User Authentication**: Secure login and registration system.
- **Inventory Management**: Manage stock levels, add new products, and use barcode scanning for quick stock updates.
- **Invoicing**: Create and manage invoices, search for customers, and apply discounts.
- **Customer Management**: Add, update, and search for customer details.
- **Supplier Management**: Manage supplier information.
- **Reports**: Generate and view various reports related to sales, inventory, and more.
- **Responsive Design**: A consistent and responsive design for better user experience across different devices.

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/electronic-shop-erp.git
   cd electronic-shop-erp
   ```

2. **Database Setup**
   - Create a MySQL database named `ElectronicsShop`.
   - Import the provided SQL file `database.sql` to create the necessary tables.
   ```bash
   mysql -u root -p ElectronicsShop < database.sql
   ```

3. **Configure Database Connection**
   - Update the database connection settings in each PHP file that connects to the database (e.g., `login.php`, `create_invoice.php`):
   ```php
   $host = 'localhost';
   $username = 'root';
   $password = 'your_password';
   $database = 'ElectronicsShop';
   ```

4. **Set Up Web Server**
   - Place the project folder in your web server's root directory (e.g., `htdocs` for XAMPP, `www` for WAMP).
   - Start the web server (e.g., Apache for XAMPP/WAMP).

5. **Access the Application**
   - Open a web browser and navigate to `http://localhost/electronic-shop-erp`.

## Usage

### Login

- Navigate to `login.php`.
- Enter your username and password to log in.
- If you don't have an account, click on the "Register" button to create one.

### Inventory Management

- Navigate to `manage_stock.php`.
- Use the barcode scanner or manually enter product details to update stock levels.

### Create Invoice

- Navigate to `create_invoice.php`.
- Search for an existing customer by ID, contact number, or email.
- If the customer is not found, use the "Add Customer" form to add new customer details.
- Add items to the invoice, apply any discounts, and submit to create the invoice.

### Customer Management

- Navigate to `customer_management.php`.
- Add, update, or search for customer details.

### Supplier Management

- Navigate to `supplier_management.php`.
- View and add supplier details.

### Reports

- Navigate to `reports.php`.
- View various reports related to sales, inventory, etc.

### Logout

- Click on the "Logout" link in the navigation bar to end your session.

## File Structure

- `index.php`: Home page with navigation.
- `login.php`: User login page.
- `register.php`: User registration page.
- `logout.php`: Logout page.
- `manage_stock.php`: Inventory management page.
- `create_invoice.php`: Create and manage invoices.
- `customer_management.php`: Manage customer details.
- `supplier_management.php`: Manage supplier details.
- `reports.php`: View reports.
- `styles.css`: Stylesheet for consistent design.

## Future Improvements

- Implement user roles and permissions.
- Add more detailed reports and analytics.
- Enhance the user interface with more interactive elements.
- Integrate with third-party services (e.g., email notifications).

## License

This project is licensed under the MIT License.

## Acknowledgements

Special thanks to all contributors and the open-source community for their invaluable resources and support.

---

Thank you for using the Electronics Shop ERP System. For any questions or support, please contact almorawaka@gmail.com.
