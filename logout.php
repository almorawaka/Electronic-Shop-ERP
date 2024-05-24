<?php
session_start();

// Destroy the session to log out the user
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=login.php"> <!-- Auto-redirect after 5 seconds -->
    <title>Logged Out - Electronic Shop ERP System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome to Electronic Shop ERP System</h1>
        <p>Goodbye!</p>
    </header>
    <nav>
        <ul>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    <div class="content">
        <h2>You have been logged out</h2>
        <p>Thank you for using the Electronic Shop ERP System.</p>
        <p>If you wish to log in again, please click <a href="login.php">here</a>.</p>
    </div>
    <footer>
        <p>© 2024 Electronic Shop ERP. All rights reserved.</p>
    </footer>
</body>
</html>
