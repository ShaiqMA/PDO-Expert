<?php
require "../includes/user-class.php";

$user = new User();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    $user->logoutUser();
    header("Location: http://localhost/PDO-Expert/user/login-user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welkom!</h2>

    <p>Je bent succesvol ingelogd en dit is je dashboard.</p>

 
    <form method="POST">
        <button type="submit" name="logout">Uitloggen</button>
    </form>
</body>
</html>
