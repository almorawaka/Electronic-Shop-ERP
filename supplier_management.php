<?php
session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$username = 'root';
$password = '123';
$database = 'ElectronicsShop';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request for adding a new supplier
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_supplier'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact_name = mysqli_real_escape_string($conn, $_POST['contact_name']);
    $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $contact_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $sql = "INSERT INTO suppliers (name, contact_name, contact_email, contact_phone, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $contact_name, $contact_email, $contact_phone, $address);
    $stmt->execute();
    $stmt->close();
}

// Fetch all suppliers
$sql = "SELECT * FROM suppliers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Management</title>
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
        <h2>Supplier List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['supplier_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['contact_name']}</td>
                            <td>{$row['contact_email']}</td>
                            <td>{$row['contact_phone']}</td>
                            <td>{$row['address']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Add New Supplier</h2>
        <form method="POST" action="supplier_management.php">
            <input type="text" name="name" placeholder="Supplier Name" required>
            <input type="text" name="contact_name" placeholder="Contact Name">
            <input type="email" name="contact_email" placeholder="Contact Email">
            <input type="text" name="contact_phone" placeholder="Contact Phone">
            <input type="text" name="address" placeholder="Address">
            <button type="submit" name="add_supplier">Add Supplier</button>
        </form>
    </div>
    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
