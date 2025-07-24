<?php
// Подключение к базе данных
$conn = new mysqli("localhost", "root", "", "bakery_db");

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение и очистка данных
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    
    // SQL запрос для вставки данных
    $sql = "INSERT INTO feedback (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
    
    if ($conn->query($sql)) {
        // Перенаправление с параметром успеха
        header("Location: obr.php?success=1");
    } else {
        // Перенаправление с параметром ошибки
        header("Location: obr.php?error=1");
    }
    exit;
}

$conn->close();
?>