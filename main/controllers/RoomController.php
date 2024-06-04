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

    public function editRoom($data) {
        return $this->model->edit($data);
    }

    public function deleteRoom($id) {
        return $this->model->delete($id);
    }
    public function checkFreeSeats($data){
        return $this->model->checkFreeSeats($data);
    }
    public function removeFreeSeat($data){
        return $this->model->removeFreeSeat($data);
    }
}
?>
