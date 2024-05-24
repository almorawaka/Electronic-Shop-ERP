<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost'; // or your host
$username = 'root'; // your MySQL username
$password = '123'; // your MySQL password
$database = 'ElectronicsShop';

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all customers
$sql = "SELECT * FROM customers";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Management</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Electronic Shop ERP System</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="manage_stock.php">Inventory Management</a></li>
            <li><a href="create_invoice.php">Create Invoice</a></li>
            <li><a href="customer_management.php">Customer Management</a></li>
            <li><a href="supplier_management.php">Supplier Management</a></li>
            <li><a href="reports.php">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
   
    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
