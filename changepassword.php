<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('config.php');

    $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
    $stmt->bind_param("si", $new_password, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Password changed successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styls.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="changepassword.php">Change Password</a></li>
                <li><a href="logout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>
    <main>

        <div class="container">
            <h2>Change Password</h2>
            <form action="changepassword.php" method="post">
                <input type="password" name="new_password" placeholder="New Password" required>
                <button type="submit">Change Password</button>
            </form>
        </div>
    </main>
</body>
</html>
