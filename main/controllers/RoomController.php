<?php
require 'C:\wamp64\www\course\main\models\Room.php';

class RoomController {
    private $model;

    public function __construct() {
        $this->model = new Room();
    }

    public function getAllRooms() {
        return $this->model->getAll();
    }

    public function addRoom($data) {
        return $this->model->add($data);
    }

    public function checkFreeSeats($data){
        return $this->model->checkFreeSeats($data);
    }
    public function updateFreeSeats($data){
        return $this->model->updateFreeSeats($data);
    }
    public function findFreeRoom(){
        return $this->model->findFreeRoom();
    }
    public function updateAllRooms($ids){
        return $this->model->updateSelectedRooms($ids);
    }
}
?>
