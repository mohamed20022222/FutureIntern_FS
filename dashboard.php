<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: signin.html');
    exit();
}

include('config.php');

$stmt = $conn->prepare("SELECT name, email, mobile, username FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$stmt->bind_result($name, $email, $mobile, $username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            <h2>Dashboard</h2>
            <p>Welcome, <?php echo $username; ?>!</p>
            <p>Name: <?php echo $name; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>Mobile: <?php echo $mobile; ?></p>
    </div>
</main>
</body>
</html>
