<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Database connection
        $conn = new mysqli("localhost", "root", "", "user_db");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve user from the database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $row['password'])) {
                echo "Login successful!";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
