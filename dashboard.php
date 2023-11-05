<?php
session_start();
require 'Auth.php';

$auth = new Auth();

if (!$auth->isAuthenticated()) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <a href="logout.php">Logout</a>
</body>
</html>
