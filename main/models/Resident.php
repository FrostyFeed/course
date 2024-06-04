<?php
class Resident {
    private $pdo;

    public function __construct() {
        require 'C:\wamp64\www\course\db.php';
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM Residents');
        return $stmt->fetchAll();
    }

    public function search($search) {
        $stmt = $this->pdo->prepare('SELECT * FROM Residents WHERE first_name LIKE ? OR last_name LIKE ?');
        $stmt->execute(['%' . $search . '%', '%' . $search . '%']);
        return $stmt->fetchAll();
    }

    public function add($data) {
        $stmt = $this->pdo->prepare('INSERT INTO Residents (first_name, last_name, date_of_birth, room_id) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['date_of_birth'], $data['room_id']]);
    }

    public function edit($data) {
        $stmt = $this->pdo->prepare('UPDATE Residents SET first_name = ?, last_name = ?, date_of_birth = ?, room_id = ? WHERE resident_id = ?');
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['date_of_birth'], $data['room_id'], $data['resident_id']]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM Residents WHERE resident_id = ?');
        return $stmt->execute([$id]);
    }
}
?>
