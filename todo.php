<?php
session_start();
include 'database.php'; // Include the database connection

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle adding a new task
if (isset($_POST['add_task'])) {
    $task = $_POST['task'];
    
    // Insert new task into the database
    $stmt = $conn->prepare("INSERT INTO tasks (user_id, task) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $task);
    $stmt->execute();
}

// Handle marking a task as completed
if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    $stmt = $conn->prepare("UPDATE tasks SET completed = 1 WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
}

// Handle deleting a task
if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $task_id);
    $stmt->execute();
}

// Fetch tasks for the logged-in user
$stmt = $conn->prepare("SELECT id, task, completed FROM tasks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .task-list {
            margin: 20px 0;
        }
        .task-item {
            background-color: white;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .completed {
            text-decoration: line-through;
        }
        .task-item button {
            background-color: red;
            color: white;
            border: none;
            cursor: pointer;
        }
        .task-item button.complete {
            background-color: green;
        }
        .add-task-container input {
            padding: 10px;
            width: 80%;
        }
        .add-task-container button {
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <h2>Your To-Do List</h2>
    <div class="add-task-container">
        <form method="POST">
            <input type="text" name="task" placeholder="New task" required>
            <button type="submit" name="add_task">Add Task</button>
        </form>
    </div>

    <div class="task-list">
        <?php while ($task = $result->fetch_assoc()): ?>
            <div class="task-item <?php echo $task['completed'] ? 'completed' : ''; ?>">
                <span><?php echo htmlspecialchars($task['task']); ?></span>
                <a href="todo.php?complete=<?php echo $task['id']; ?>"><button class="complete">Complete</button></a>
                <a href="todo.php?delete=<?php echo $task['id']; ?>"><button>Delete</button></a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
