<?php
class Room {
    private $pdo;

    public function __construct() {
        require 'C:\wamp64\www\course\db.php';
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM Rooms');
        return $stmt->fetchAll();
    }

    public function add($data) {
        $stmt = $this->pdo->prepare('INSERT INTO Rooms (room_number, capacity,free_seats) VALUES (?, ?,?)');
        return $stmt->execute([$data['room_number'], $data['capacity'],$data['capacity']]);
    }

    public function findFreeRoom(){
        $stmt = $this->pdo->prepare('SELECT room_number FROM Rooms WHERE free_seats != 0 LIMIT 1');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFreeSeats($data){
        $stmt = $this->pdo->prepare('SELECT free_seats FROM Rooms WHERE room_number = ?');
        $stmt->execute([$data]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function checkFreeSeats($data){
        $freeSeats = $this->getFreeSeats($data);
        return $freeSeats['free_seats'];
    }
    public function updateFreeSeats($data){
        $roomCapacity = $this->getRoomCapacity($data);
        $peopleInRoom = $this->getAmountOfPeopleInRoom($data);
        $freeSeats = $roomCapacity - $peopleInRoom;
        $stmt = $this->pdo->prepare('UPDATE Rooms SET free_seats = ? WHERE room_number = ?');
        $stmt->execute([$freeSeats, $data]);
        return $freeSeats;
    }
    public function getAmountOfPeopleInRoom($data){
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as amount FROM Residents WHERE room_id = ?');
        $stmt->execute([$data]);
        $amount = $stmt->fetch(PDO::FETCH_ASSOC);
        return $amount['amount'];
    }
    public function getRoomCapacity($data){
        $stmt = $this->pdo->prepare('SELECT capacity FROM Rooms WHERE room_number = ?');
        $stmt->execute([$data]);
        $amount = $stmt->fetch(PDO::FETCH_ASSOC);
        return $amount['capacity'];
    }
    public function updateSelectedRooms($ids){
        $array = explode(',',$ids);
        $newSeats = [];
        foreach($array as $id){
            array_push($newSeats,$this->updateFreeSeats($id));
        }
        return $newSeats;
    }
}
?>
