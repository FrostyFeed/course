<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

require 'C:\wamp64\www\course\main\controllers\RoomController.php';

$roomController = new RoomController();
$action = $_POST['action'];

switch ($action) {
    case 'add':
        $data = [
            'room_number' => $_POST['room_number'],
            'capacity' => $_POST['capacity']
        ];
        $roomController->addRoom($data);
        break;

    case 'findFreeRoom':
        $room = $roomController->findFreeRoom();
        echo $room['room_number'];
        exit();
        break;
    default:
        echo 'Невідома дія';
        exit();
}

header('Location: ../test.php');
exit();
?>
