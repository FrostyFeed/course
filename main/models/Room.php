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

    public function edit($data) {
        $stmt = $this->pdo->prepare('UPDATE Rooms SET room_number = ?, capacity = ? WHERE room_id = ?');
        return $stmt->execute([$data['room_number'], $data['capacity'], $data['room_id']]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM Rooms WHERE room_id = ?');
        return $stmt->execute([$id]);
    }

    public function getFreeSeats($data){
        $stmt = $this->pdo->prepare('SELECT free_seats FROM Rooms WHERE room_number = ?');
        $stmt->execute([$data['room_id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function checkFreeSeats($data){
        $freeSeats = $this->getFreeSeats($data);
        return $freeSeats['free_seats'];
    }
    public function removeFreeSeat($data){
        $freeSeats = $this->checkFreeSeats($data) - 1;
        print_r($data['room_id']);
        $stmt = $this->pdo->prepare('UPDATE Rooms SET free_seats = ? WHERE room_number = ?');
        return $stmt->execute([$freeSeats, $data['room_id']]);
    }
    
}
?>
