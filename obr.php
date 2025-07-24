<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery's - Обратная связь</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="menu-container">
        <div class="menu">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <div class="button">
                <ul>
                    <li><a href="index.html" class="btn0">Главная</a></li>
                    <li><a href="about.html" class="btn1">О Пекарне</a></li>
                    <li><a href="menu.html" class="btn2">Меню</a></li>
                    <li><a href="obr.php" class="btn4">Обратная связь</a></li>
                    <li><a href="contacts.html" class="btn3">Контакты</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="feedback">
        <h1>Обратная связь</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">Спасибо! Ваш отзыв успешно отправлен.</div>
        <?php endif; ?>
        
        <form action="process_feedback.php" method="POST" class="feedback-form">
            <div class="form-group">
                <label for="name">ФИО:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Телефон:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="message">Ваш отзыв:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">Отправить</button>
        </form>
    </div>

    <div class="container">
        <h2 class="title">Отзывы наших клиентов</h2>
        
        <?php
        $conn = new mysqli("localhost", "root", "", "bakery_db");
        
        if ($conn->connect_error) {
            die("Ошибка подключения: " . $conn->connect_error);
        }
        
        $sql = "SELECT name, phone, email, message, created_at FROM feedback ORDER BY created_at DESC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo '<table class="table">';
            echo '<tr><th>ФИО</th><th>Телефон</th><th>Email</th><th>Отзыв</th><th>Дата</th></tr>';
            
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["phone"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
                echo '<td>' . htmlspecialchars($row["message"]) . '</td>';
                echo '<td>' . $row["created_at"] . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
        } else {
            echo '<p class="no-reviews">Пока нет отзывов. Будьте первым!</p>';
        }
        
        $conn->close();
        ?>
    </div>
</body>
</html>