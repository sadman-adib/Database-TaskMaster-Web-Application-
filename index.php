<?php
session_start();
include 'db_config.php';

// Handle user registration
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["reg-username"];
    $password = $_POST["reg-password"];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('User registered successfully');</script>";
    } else {
        echo "<script>alert('Error registering user');</script>";
    }
}

// Handle user login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = $_POST["login-username"];
    $password = $_POST["login-password"];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        echo "<script>alert('Login successful');</script>";
    } else {
        echo "<script>alert('Login failed');</script>";
    }
}

// Handle task creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task"])) {
    if (isset($_SESSION['user_id'])) {
        $task = $_POST["task"];
        $user_id = $_SESSION['user_id'];

        $query = "INSERT INTO tasks (user_id, task_name) VALUES ('$user_id', '$task')";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('Task created successfully');</script>";
        } else {
            echo "<script>alert('Error creating task');</script>";
        }
    } else {
        echo "<script>alert('User not logged in');</script>";
    }
}

// Handle task deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-task"])) {
    if (isset($_SESSION['user_id'])) {
        $task_id = $_POST["task-id"];
        $user_id = $_SESSION['user_id'];

        $query = "DELETE FROM tasks WHERE id='$task_id' AND user_id='$user_id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('Task deleted successfully');</script>";
        } else {
            echo "<script>alert('Error deleting task');</script>";
        }
    } else {
        echo "<script>alert('User not logged in');</script>";
    }
}

// Handle task update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update-task"])) {
    if (isset($_SESSION['user_id'])) {
        $task_id = $_POST["task-id"];
        $completed = $_POST["completed"];
        $user_id = $_SESSION['user_id'];

        $query = "UPDATE tasks SET completed='$completed' WHERE id='$task_id' AND user_id='$user_id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            echo "<script>alert('Task updated successfully');</script>";
        } else {
            echo "<script>alert('Error updating task');</script>";
        }
    } else {
        echo "<script>alert('User not logged in');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaster</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>TaskMaster</h1>
        <div id="auth-forms">
            <form id="register-form" method="post">
                <h2>Register</h2>
                <input type="text" name="reg-username" placeholder="Username" required>
                <input type="password" name="reg-password" placeholder="Password" required>
                <button type="submit" name="register">Register</button>
            </form>
            <form id="login-form" method="post">
                <h2>Login</h2>
                <input type="text" name="login-username" placeholder="Username" required>
                <input type="password" name="login-password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
        <div id="task-form-container">
            <form id="task-form" method="post">
                <input type="text" name="task" placeholder="Enter task..." required>
                <button type="submit">Add Task</button>
            </form>
        </div>
        <ul id="task-list">
            <?php
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM tasks WHERE user_id='$user_id'";
            $result = mysqli_query($connection, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>{$row['task_name']} ";
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='hidden' name='task-id' value='{$row['id']}'>";
                    echo "<select name='completed'>";
                    echo "<option value='0'>Incomplete</option>";
                    echo "<option value='1'>Complete</option>";
                    echo "</select>";
                    echo "<button type='submit' name='update-task'>Update</button>";
                    echo "</form>";
                    echo "<form method='post' style='display: inline;'>";
                    echo "<input type='hidden' name='task-id' value='{$row['id']}'>";
                    echo "<button type='submit' name='delete-task'>Delete</button>";
                    echo "</form>";
                    echo "</li>";
                }
            } else {
                echo "<li>No tasks found</li>";
            }
            ?>
        </ul>
        <?php endif; ?>
    </div>
</body>
</html>
