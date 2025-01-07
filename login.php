<?php
session_start();
include 'database.php'; // Include the database connection

// Handle login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by username
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $stored_password);
        $stmt->fetch();

        // Verify password
        if ($password == $stored_password) { // Use password verification
            $_SESSION['user_id'] = $id;
            header("Location: todo.php"); // Redirect to the To-Do list page
            exit(); // Stop execution after redirection
        } else {
            echo "Invalid login credentials!";
        }
    } else {
        echo "No user found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 300px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6);
        }
        .container h2 {
            text-align: center;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 93%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 17px;
        }
    </style>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" id="username" required><br>
        <input type="password" name="password" placeholder="Password" id="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</div>
</body>
</html>