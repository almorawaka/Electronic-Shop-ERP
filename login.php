<?php
session_start();
$host = 'localhost'; // or your host
$username = 'root'; // your MySQL username
$password = '123'; // your MySQL password
$database = 'ElectronicsShop';

$conn = new mysqli($host, $username, $password, $database);
if ($conn-> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $uname = mysqli_real_escape_string($conn, $_POST['username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($pwd, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid username or password!";
        }
    } else {
        $message = "Invalid username or password!";
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style=" display: flex; justify-content: center; align-items: center; height: 100vh">
    <div class="form-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="Login">
            </div>
            <p><?php echo $message; ?></p>
        </form>
        <form action="register.php">
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
