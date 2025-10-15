<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        echo "Регистрация прошла успешно!";
        $stmt->close();
    } else {
        echo "Ошибка: " . $conn->error;
    }
}

$conn->close();
?>
