<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ..\views\dashboard.php');
    exit();
}
require 'C:\wamp64\www\course\main\controllers\ResidentController.php';
require 'C:\wamp64\www\course\main\controllers\RoomController.php';
$residentController = new ResidentController();
$roomController = new RoomController();
$action = $_POST['action'];

switch ($action) {
    case 'add':
        $data = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'room_id' => $_POST['room_id']
        ];
        if($roomController->checkFreeSeats($data)){
            $residentController->addResident($data);
            $roomController->removeFreeSeat($data);
        }
        else{
            header('Location: ..\test.php?error=В кімнаті всі місця зайняті');
        }
        break;

    case 'delete':
        $id = $_POST['resident_id'];
        $residentController->deleteResident($id);
        break;

    case 'edit':
        $data = [
            'resident_id' => $_POST['resident_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'room_id' => $_POST['room_id']
        ];
        $residentController->editResident($data);
        break;

    case 'search':
        $search = $_POST['search'];
        $_SESSION['search_results'] = $residentController->searchResidents($search);
        break;

    default:
        echo 'Невідома дія';
        exit();
}

header('Location: ..\test.php');
exit();
?>
