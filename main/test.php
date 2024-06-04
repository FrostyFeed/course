<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

require 'C:\wamp64\www\course\db.php';
require 'C:\wamp64\www\course\main\controllers\ResidentController.php';
require 'C:\wamp64\www\course\main\controllers\RoomController.php';

$residentController = new ResidentController();
$roomController = new RoomController();

$residents = $residentController->getAllResidents();
$rooms = $roomController->getAllRooms();

include 'views/dashboard.php';
?>
