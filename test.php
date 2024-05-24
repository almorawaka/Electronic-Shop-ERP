<?php
session_start();

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

// Handle barcode input for product details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['barcode_input'])) {
    $barcode = mysqli_real_escape_string($conn, $_POST['barcode_input']);
    $sql = "SELECT * FROM availableStock WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $barcode);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

// Fetch all stock
$sql = "SELECT * FROM availableStock";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Stock</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function handleBarcodeInput() {
            document.getElementById('barcodeForm').submit();
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
            <!-- Add other navigation items here -->
        </ul>
    </nav>
    <div class="content">
        <h2>Scan Barcode</h2>
        <form id="barcodeForm" method="POST" action="manage_stock.php">
            <input type="text" name="barcode_input" oninput="handleBarcodeInput()" autofocus>
        </form>

        <?php if (isset($product)): ?>
            <h3>Product Details:</h3>
            <p>ID: <?php echo $product['product_id']; ?></p>
            <p>Name: <?php echo $product['product_name']; ?></p>
            <!-- Display other product details -->
        <?php endif; ?>

        <h2>Stock List</h2>
        <!-- Stock list table goes here -->
    </div>
    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
