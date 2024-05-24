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

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert new customer
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO customers (name, email, contact_number, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $address);
    $stmt->execute();
    echo "New record created successfully";
    $stmt->close();
}

// Retrieve all customers
$sql = "SELECT id, name, email, contact_number, address FROM customers";
$result = $conn->query($sql);
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
    <div class="content">
        <h2>Customer List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['contact_number']}</td>
                                <td>{$row['address']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No customers found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<h2>Add New Customer</h2>
<form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="contact">Contact Number:</label>
    <input type="text" id="contact" name="contact"><br><br>
    <label for="address">Address:</label>
    <textarea id="address" name="address"></textarea><br><br>
    <input type="submit" value="Submit">
</form>

</body>
</html>
<?php
$conn->close();
?>
