<?php
session_start();
require_once "../config/database.php";
require_once "../src/models/User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $user->login();
    
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: tasks.php");
            exit();
        } else {
            $_SESSION['error'] = "Senha incorreta!";
            header("Location: index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Usuário não encontrado!";
        header("Location: index.php");
        exit();
    }
}
?>
