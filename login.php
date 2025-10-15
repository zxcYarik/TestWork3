<?php

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                echo "Вы успешно вошли!";
            } else {
                echo "Неверный пароль!";
            }
        } else {
            echo "Пользователь не найден!";
        }

        $stmt->close();
    } else {
        echo "Ошибка: " . $conn->error;
    }
}

$conn->close();
?>
