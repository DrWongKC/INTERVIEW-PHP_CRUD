<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'grabjobs') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name = ' ';
$description = ' ';
$created = ' ';

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['created'];

    $mysqli->query("INSERT INTO users (name, description, created) VALUES ('$name', '$description', '$date')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM users WHERE id=$id") or die($mysqli->error);
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or die($mysqli->error);
    if (isset($result)) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $description = $row['description'];
        $date = $row['created'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created = $_POST['created'];

    $result = $mysqli->query("UPDATE users SET name='$name', description='$description', created='$created' WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "Warning";

    header('location: index.php');
}