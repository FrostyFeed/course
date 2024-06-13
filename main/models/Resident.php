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
        return $this->makeSearchQuery($search);
    }

    public function add($data) {
        $stmt = $this->pdo->prepare('INSERT INTO Residents (first_name, last_name, date_of_birth, room_id,course) VALUES (?, ?, ?, ?,?)');
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['date_of_birth'], $data['room_id'],$data['course']]);
    }

    public function edit($data) {
        $stmt = $this->pdo->prepare('UPDATE Residents SET first_name = ?, last_name = ?, date_of_birth = ?, room_id = ?, course = ? WHERE resident_id = ?');
        return $stmt->execute([$data['first_name'], $data['last_name'], $data['date_of_birth'], $data['room_id'],$data['course'] ,$data['resident_id']]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM Residents WHERE resident_id = ?');
        return $stmt->execute([$id]);
    }
    public function deleteSelected($id){
        $array = explode(',',$id);
        $stmt = $this->pdo->prepare($this->makeDeleteQuery($array));
        return $stmt->execute($array);
    }
    public function makeSearchQuery($data){
        $parms = 0;
        $array = array_keys($data);
        $sql = 'SELECT * FROM Residents WHERE ';
        $sqlParams = [];
        for($i=0;$i < sizeof($array);$i++){
            if(strlen($data[$array[$i]])!=0){
                if($parms == 0){
                    $sql .= $array[$i] . ' = ' .'?';
                    $parms++;
                }else{
                    $sql .= " AND " . $array[$i] .' = ' .'?';
                }
                array_push($sqlParams,$data[$array[$i]]);
            }
        }
        print_r($sql);
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($sqlParams);
        return $stmt->fetchAll();
    }
    public function makeDeleteQuery($id){
        $moreThanOneParam = false;
        $sql = 'DELETE FROM Residents WHERE resident_id IN(';
        for($i = 0;$i< sizeof($id);$i++){
            if(!$moreThanOneParam){
                $sql .= '?';
                $moreThanOneParam = true;
            }
            else{
                $sql .= ',?';
            }
        }
        $sql .= ')';
        return $sql;
    }
}
?>
