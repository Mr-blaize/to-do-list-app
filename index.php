<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TO DO </title>
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
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
<body>
<div class="container">
    <h2>Welcome to Todo App</h2>
    <a href="login.php"><button class="btn">Login</button></a>
    <a href="register.php"><button class="btn">Sign Up</button></a>
</div>
</body>
</html>