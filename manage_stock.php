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

// Handling POST request for Add/Edit/Delete
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];
    $supplier_id = $_POST['supplier_id'];
    $description = $_POST['description'];
    
    if ($action == 'add') {
        $sql = "INSERT INTO availableStock (product_name, category, quantity, unit_price, supplier_id, description) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidss", $product_name, $category, $quantity, $unit_price, $supplier_id, $description);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'edit') {
        $product_id = $_POST['product_id'];
        $sql = "UPDATE availableStock SET product_name=?, category=?, quantity=?, unit_price=?, supplier_id=?, description=? WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssidssi", $product_name, $category, $quantity, $unit_price, $supplier_id, $description, $product_id);
        $stmt->execute();
        $stmt->close();
    } elseif ($action == 'delete') {
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM availableStock WHERE product_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Fetch all products
$sql = "SELECT * FROM availableStock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Stock</title>
    <link rel="stylesheet" href="styles.css">
    <title>Stock Management</title>

  
    <script>
        function setFormForEdit(product_id, product_name, category, quantity, unit_price, supplier_id, description) {
            document.getElementById('product_id').value = product_id;
            document.getElementById('product_name').value = product_name;
            document.getElementById('category').value = category;
            document.getElementById('quantity').value = quantity;
            document.getElementById('unit_price').value = unit_price;
            document.getElementById('supplier_id').value = supplier_id;
            document.getElementById('description').value = description;
            document.getElementById('action').value = 'edit';
        }
    </script>
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
</head>
<body>


     

<div class="content">
<h2>Manage Stock</h2>
<form action="" method="post">
    <input type="hidden" id="product_id" name="product_id">
    <input type="hidden" id="action" name="action" value="add">
    <label for="product_name">Product Name:</label>
    <input type="text" id="product_name" name="product_name" required><br><br>
   
    <label for="category">Category:</label>
    
    <select name="category" id="category">
        <option value="Semiconductors"> <b>&nbsp;&nbsp;--------  Semiconductors  -------- </b></option>
        <option value="Transistors">Transistors</option>
        <option value="Diodes">Diodes</option>
        <option value="Integrated Circuits (ICs)">Integrated Circuits (ICs)</option>
        <option value="Microcontrollers">Microcontrollers</option>
        <option value="Power Management ICs ">Power Management ICs</option>

        <option value="Passive Components ">&nbsp;&nbsp;--------  Passive Components  --------  </option>
        <option value="Resistors"> Resistors</option>
        <option value="Capacitors"> Capacitors</option>
        <option value="Inductors"> Inductors</option>
        <option value="Transformers"> Transformers</option>
        <option value="Potentiometers"> Potentiometers</option>

        <option value="Electromechanical Components ">&nbsp;&nbsp;--------  Electromechanical Components  --------</option>
        <option value="Relays ">Relays</option>
        <option value="Switches">Switches</option>
        <option value="Connectors">Connectors</option>
        <option value="Sockets ">Sockets</option>
        <option value="Terminal Blocks">Terminal Blocks</option>

        <option value="Power Supplies">&nbsp;&nbsp;--------  Power Supplies -----------</option>
        <option value="Batteries"> Batteries</option>
        <option value="Chargers">Chargers</option>
        <option value="Power Adapters">Power Adapters</option>
        <option value="Inverters">Inverters</option>
        <option value="Solar Panels">Solar Panels</option>

        <option value="Sensors and Modules ">&nbsp;&nbsp;--------  Sensors and Modules  ----------</option>
        <option value="Temperature Sensors ">Temperature Sensors</option>
        <option value="Humidity Sensors">Humidity Sensors</option>
        <option value="Pressure Sensors ">Pressure Sensors</option>
        <option value="Proximity Sensors">Proximity Sensors</option>
        <option value="Motion Sensors">Motion Sensors</option>
        <option value="Wireless Modules (WiFi, Bluetooth, Zigbee)"> Wireless Modules (WiFi, Bluetooth, Zigbee)</option>

        <option value="Optoelectronics ">&nbsp;&nbsp;--------  Optoelectronics -----------</option>
        <option value="LEDs">LEDs</option>
        <option value="Photodiodes">Photodiodes</option>
        <option value="Laser Diodes">Laser Diodes</option>
        <option value="Optocouplers">Optocouplers</option>
        <option value="Displays (LCD, OLED)">Displays (LCD, OLED)</option>

        <option value="Cables and Wires">&nbsp;&nbsp;--------   Cables and Wires   --------  </option>
        <option value="Power Cables">Power Cables</option>
        <option value="Data Cables">Data Cables</option>
        <option value="Coaxial Cables">Coaxial Cables</option>
        <option value="Ribbon Cables">Ribbon Cables</option>
        <option value="Connectors and Adapters ">Connectors and Adapters</option>

        <option value="Hardware">&nbsp;&nbsp; --------   Hardware  ------------ </option>
        <option value="Screws and Nuts"> Screws and Nuts</option>
        <option value="Standoffs and Spacers">Standoffs and Spacers</option>
        <option value="Heat Sinks">Heat Sinks</option>
        <option value="Enclosures">Enclosures</option>
        <option value="Mounting Brackets ">Mounting Brackets</option>

        <option value="Pneumatic Components">&nbsp;&nbsp;--------  Pneumatic Components  --------  </option>
        <option value="Pneumatic Cylinders">Pneumatic Cylinders</option>
        <option value="Solenoid Valves">Solenoid Valves</option>
        <option value="O Rings">O rings</option>
        <option value="Air Filters">Air Filters</option>
        <option value="Regulators">Regulators</option>
        <option value="Fittings and Tubing">Fittings and Tubing</option>

        <option value="Mechanical Components">&nbsp;&nbsp;--------  Mechanical Components --------  </option>
        <option value="Bearings">Bearings</option>
        <option value="Gears">Gears</option>
        <option value="Pulleys ">Pulleys</option>
        <option value="Shafts">Shafts</option>
        <option value="Springs ">Springs</option>

        <option value="Tools and Equipment">&nbsp;&nbsp;--------  Tools and Equipment  --------  </option>
        <option value="Soldering Irons">Soldering Irons</option>
        <option value="Multimeters"> Multimeters</option>
        <option value="Oscilloscopes"> Oscilloscopes</option>
        <option value="Power Supplies"> Power Supplies</option>
        <option value="Hand Tools (screwdrivers, pliers) ">Hand Tools (screwdrivers, pliers)</option>
        
        <option value="Development Boards and Kits">&nbsp;&nbsp;--------  Development Boards and Kits  --------  </option>
        <option value="Arduino"> Arduino</option>
        <option value="Raspberry Pi">Raspberry Pi</option>
        <option value="Development Kits ">Development Kits</option>
        <option value="Breadboards">Breadboards</option>
        <option value="Prototyping Boards ">Prototyping Boards</option>

        <option value="Computer Components ">&nbsp;&nbsp;--------  Computer Components--------  </option>
        <option value="Microprocessors"> Microprocessors</option>
        <option value="Memory (RAM)"> Memory (RAM)</option>
        <option value="Storage (HDD, SSD)"> Storage (HDD, SSD)</option>
        <option value="Graphic Cards"> Graphic Cards</option>
        <option value="Motherboards ">Motherboards</option>

        <option value="Networking Components ">&nbsp;&nbsp;--------  Networking Components  --------  </option>
        <option value="Routers ">Routers</option>
        <option value="witches ">Switches</option>
        <option value="Ethernet Cables ">Ethernet Cables</option>
        <option value="WiFi Modules">WiFi Modules</option>
        <option value="Antennas">Antennas</option>

        <option value="Audio Components">&nbsp;&nbsp;--------  Audio Components  --------  </option>
        <option value="peakers "> Speakers</option>
        <option value="Microphones ">Microphones</option>
        <option value="Amplifiers ">Amplifiers</option>
        <option value="Audio Cables ">Audio Cables</option>
        <option value="Audio Jacks and Plugs">Audio Jacks and Plugs</option>
     
      </select><br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" required><br><br>
    <label for="unit_price">Unit Price:</label>
    <input type="text" id="unit_price" name="unit_price" required><br><br>
    <label for="supplier_id">Supplier ID:</label>
    <input type="number" id="supplier_id" name="supplier_id"><br><br>
    <label for="description">Description:</label>
    <textarea id="description" name="description" maxlength="255"></textarea><br><br>
    <input type="submit" value="Submit">
    
</form>
</div >
<br><br>
<br><br>

<div class="content">
<h3>Stock List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Supplier ID</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['category']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['unit_price']}</td>
                <td>{$row['supplier_id']}</td>
                <td>{$row['description']}</td>
                <td>
                    <button onclick=\"setFormForEdit('{$row['product_id']}', '{$row['product_name']}', '{$row['category']}', '{$row['quantity']}', '{$row['unit_price']}', '{$row['supplier_id']}', '{$row['description']}')\">Edit</button>
                    <form action='' method='post' style='display:inline'>
                        <input type='hidden' name='product_id' value='{$row['product_id']}'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='submit' value='Delete'>
                    </form>
                </td>
              </tr>";
    }
    ?>




</div>

</body>
</html>

<?php
$conn->close();
?>
