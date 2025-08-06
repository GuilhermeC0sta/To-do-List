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
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "As senhas não coincidem!";
        header("Location: register.php");
        exit();
    }

    $user->password = $password;

    if ($user->create()) {
        $_SESSION['success'] = "Conta criada com sucesso! Faça login para continuar.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Erro ao criar conta. Tente novamente.";
        header("Location: register.php");
        exit();
    }
}
?>
