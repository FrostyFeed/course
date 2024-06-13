<?php
session_start();

if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
    header('Location: ..\main\test.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизація</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h2>Авторизація</h2>
        <form action="login/login.php" method="post">
            <label for="username">Ім'я користувача:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
            <div class="checkbox-container">
                <label for="remember_me" id="rmbrLabel">Запам'ятати мене</label>
                <input type="checkbox" name="remember_me" id="remember_me">
            </div>
            <button type="submit">Увійти</button>
        </form>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>
    </div>
</body>

</html>