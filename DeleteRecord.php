<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'config.php';
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");

    try {
        $stmt->execute(['id' => $id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("The record could not be deleted: " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit;
}
?>
