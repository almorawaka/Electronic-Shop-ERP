<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
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
    <div class="content">
        <h2>Reports Dashboard</h2>
        <p>This section will provide reports on sales, inventory, customer interactions, and more. Implementation details will depend on specific business needs.</p>
    </div>
    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
