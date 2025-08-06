<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once "../config/database.php";
require_once "../src/models/Task.php";

$database = new Database();
$db = $database->getConnection();
$task = new Task($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title'])) {
        $task->user_id = $_SESSION['user_id'];
        $task->title = $_POST['title'];
        $task->description = $_POST['description'];
        $task->status = $_POST['status'];

        if (isset($_POST['id'])) {
            // Update existing task
            $task->id = $_POST['id'];
            if ($task->update()) {
                $_SESSION['success'] = "Tarefa atualizada com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao atualizar tarefa.";
            }
        } else {
            // Create new task
            if ($task->create()) {
                $_SESSION['success'] = "Tarefa criada com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao criar tarefa.";
            }
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    if (isset($_GET['id'])) {
        $task->id = $_GET['id'];
        $task->user_id = $_SESSION['user_id'];
        
        if ($task->delete()) {
            http_response_code(200);
            echo json_encode(array("message" => "Tarefa excluída com sucesso."));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Erro ao excluir tarefa."));
        }
        exit();
    }
}

header("Location: tasks.php");
exit();
?>
