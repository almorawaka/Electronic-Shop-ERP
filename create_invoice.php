<?php
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$host = 'localhost';
$username = 'root';
$password = '123';
$database = 'ElectronicsShop';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customer_found = false;
$customerInfo = null;

// Function to fetch customer information
function fetchCustomer($conn, $search) {
    $sql = "SELECT * FROM customers WHERE id=? OR contact_number=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Handling POST request for customer search
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_customer'])) {
    $search = $_POST['search'];
    $customerInfo = fetchCustomer($conn, $search);
    $customer_found = $customerInfo ? true : false;
}

// Handling POST request for Add/Edit/Delete Items
$invoiceItems = [];
$totalPrice = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    foreach ($_POST['product_id'] as $key => $value) {
        $product_id = $value;
        $quantity = $_POST['quantity'][$key];

        // Fetch product details
        $stmt = $conn->prepare("SELECT product_name, unit_price FROM availableStock WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $price = $row['unit_price'] * $quantity;
            $totalPrice += $price;
            $invoiceItems[] = [
                'product_name' => $row['product_name'],
                'quantity' => $quantity,
                'unit_price' => $row['unit_price'],
                'total' => $price
            ];
        }
        $stmt->close();
    }

    // Apply discount if any
    $discount = $_POST['discount'] ?? 0;
    $totalPrice *= (1 - ($discount / 100));
}

// Adding new customer
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_customer'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact_number'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO customers (name, email, contact_number, address) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $contact, $address);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Invoice</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function addRow() {
            var table = document.getElementById("itemsTable");
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            cell1.innerHTML = '<input type="text" name="product_id[]" required>';
            cell2.innerHTML = '<input type="text" name="quantity[]" required>';
        }
    </script>
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
        <h2>Create Invoice</h2>

        <!-- Customer Search Form -->
        <h3>Search Customer</h3>
        <form method="post">
            <label for="search">Search by ID, Contact Number, or Email:</label>
            <input type="text" id="search" name="search" required>
            <input type="submit" name="search_customer" value="Search">
        </form>

        <?php if ($customer_found): ?>
            <h4>Customer Details</h4>
            <p>Name: <?= htmlspecialchars($customerInfo['name']) ?></p>
            <p>Email: <?= htmlspecialchars($customerInfo['email']) ?></p>
            <p>Contact Number: <?= htmlspecialchars($customerInfo['contact_number']) ?></p>
            <p>Address: <?= htmlspecialchars($customerInfo['address']) ?></p>
        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_customer'])): ?>
            <h3>Add Customer</h3>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="contact_number">Contact Number:</label>
                <input type="text" id="contact_number" name="contact_number" required><br><br>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required><br><br>
                <input type="submit" name="add_customer" value="Add Customer">
            </form>
        <?php endif; ?>
    </div>

    <!-- Invoice Item Form -->
    <div class="content">
        <h3>Add Items to Invoice</h3>
        <form method="post">
            <table id="itemsTable">
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <td><input type="text" name="product_id[]" required></td>
                    <td><input type="text" name="quantity[]" required></td>
                </tr>
            </table>
            <br>
            <button type="button" onclick="addRow()">Add More Items</button><br><br>
            <label for="discount">Discount (%): </label>
            <input type="number" id="discount" name="discount" min="0" max="100" step="1" value="0"><br><br>
            <input type="submit" name="submit" value="Create Invoice">
        </form>
    </div>

    <?php if (!empty($invoiceItems)): ?>
        <div class="content">
            <h3>Invoice Details</h3>
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($invoiceItems as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= htmlspecialchars($item['quantity']) ?></td>
                        <td><?= number_format($item['unit_price'], 2) ?></td>
                        <td><?= number_format($item['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3">Total After Discount</td>
                    <td><?= number_format($totalPrice, 2) ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>

    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
