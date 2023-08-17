<?php

function getAllTodos($db)
{
    $sql = 'SELECT * FROM todos';
    $conn = $db->connect();
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // Vous pouvez également enregistrer $e->getMessage() dans un fichier log pour un dépannage ultérieur
        return [];
    } finally {
        $stmt = null;
        $conn = null;
    }
}

function render($view, $data)
{
    if (file_exists("views/view.{$view}.php")) {
        extract($data);
        require_once "views/view.{$view}.php";
    }
}

function addTodo($db, $title) {
    $sql = 'INSERT INTO todos (title, status) VALUES (?, 0)';
    $conn = $db->connect();
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$title]);
        return true;
    } catch (PDOException $e) {
        return false;
    } finally {
        $stmt = null;
        $conn = null;
    }
}

function updateTodoStatus($db, $id, $status) {
    $sql = 'UPDATE todos SET status = ? WHERE id = ?';
    $conn = $db->connect();
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute([$status, $id]);
        return true;
    } catch (PDOException $e) {
        return false;
    } finally {
        $stmt = null;
        $conn = null;
    }
}
