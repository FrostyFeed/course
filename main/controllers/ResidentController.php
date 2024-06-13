<?php
require 'C:\wamp64\www\course\main\models\Resident.php';

class ResidentController {
    private $model;

    public function __construct() {
        $this->model = new Resident();
    }

    public function getAllResidents() {
        return $this->model->getAll();
    }

    public function searchResidents($search) {
        return $this->model->search($search);
    }

    public function addResident($data) {
        return $this->model->add($data);
    }

    public function editResident($data) {
        return $this->model->edit($data);
    }

    public function deleteResident($id) {
        return $this->model->delete($id);
    }
    public function deleteSelected($id){
        return $this->model->deleteSelected($id);
    }
}
?>
