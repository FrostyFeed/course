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
            'room_id' => $_POST['room_id'],
            'course' => $_POST['course']
        ];
        if($roomController->checkFreeSeats($data['room_id'])){
            $residentController->addResident($data);
            $roomController->updateFreeSeats($data['room_id']);
            
        }
        else{
            header('Location: ..\test.php?error=В кімнаті всі місця зайняті');
            exit();
        }
        break;

    case 'delete':
        $id = $_POST['resident_id'];
        $residentController->deleteResident($id);
        $freeSeats = $roomController->updateFreeSeats($_POST['room_id']);
        echo $freeSeats;
        exit();
        break;
    case 'deleteSelected':
        $id = $_POST['id'];
        $residentController->deleteSelected($id);
        $array = explode(',',$_POST['rooms']);
        $json = [];
        foreach($array as $seat){
            $newSeat = $roomController->updateFreeSeats($seat);
            echo $newSeat . " ";
        }
        exit();
        break;
    case 'edit':
        $data = [
            'resident_id' => $_POST['resident_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'date_of_birth' => $_POST['date_of_birth'],
            'room_id' => $_POST['room_id'],
            'course' => $_POST['course']
        ];
        if($_POST['old_room'] != $data['room_id']){
            if($roomController->checkFreeSeats($data['room_id'])){
                $residentController->editResident($data);
                $newRoom =  $roomController->updateFreeSeats($data['room_id']);
                $oldRoom =  $roomController->updateFreeSeats($_POST['old_room']);
                $json = array("newRoom" =>$newRoom,"oldRoom" => $oldRoom );
                echo json_encode($json);
            }else{
                http_response_code(400);
                
            }
        }
        else{
            $residentController->editResident($data);
        }
        exit();
        break;

    case 'search':
        $data = [
            'first_name' => $_POST['name'],
            'last_name' => $_POST['secondName'],
            'date_of_birth' => $_POST['date'],
            'room_id' => $_POST['room'],
            'course' => $_POST['course']
        ];
        $_SESSION['search_results'] = $residentController->searchResidents($data);
        break;

    default:
        echo 'Невідома дія';
        exit();
}

header('Location: ..\test.php');
exit();
?>
