<?php
session_start();
require '..\db.php'; // файл для підключення до бази даних

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Перевірка введених даних
    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Будь ласка, заповніть всі поля');
        exit();
    }

    // Підключення до бази даних через PDO
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        // Перевірка пароля
        if ($user && $password == $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: ..\main\test.php'); // сторінка після успішного входу
            exit();
        } else {
            header('Location: index.php?error=Невірне ім\'я користувача або пароль');
            exit();
        }
    } catch (PDOException $e) {
        echo 'Помилка підключення до бази даних: ' . $e->getMessage();
    }
} else {
    header('Location: index.php');
    exit();
}
?>
