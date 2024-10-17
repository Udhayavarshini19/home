<?php
session_start();
require_once './scripts/DB.php';

if (isset($_POST['login'])) {
    $contact = trim($_POST['contact']);
    $password = trim($_POST['password']);

    // Fetch user data
    $query = "SELECT id, name, password FROM users WHERE contact = ?";
    $user = DB::query($query, [$contact])->fetch(PDO::FETCH_OBJ);

    if ($user && password_verify($password, $user->password)) {
        // Set session variables for user ID and name
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        
        // Redirect to the user dashboard
        header("Location: user_dashboard.php");
        exit();
    } else {
        // Redirect to login page with error message
        header("Location: userlogin.php?error=Invalid contact or password");
        exit();
    }
}
