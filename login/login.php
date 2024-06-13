<?php
session_start();
require '..\db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember_me']);
    if (empty($username) || empty($password)) {
        header('Location: index.php?error=Будь ласка, заповніть всі поля');
        exit();
    }

    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['password']) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($rememberMe) {
                setcookie('user_id', $user['user_id'], time() + (86400 * 30), "/"); // 30 days
                setcookie('username', $user['username'], time() + (86400 * 30), "/"); // 30 days
            }
            header('Location: ../../main/test.php'); 
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
