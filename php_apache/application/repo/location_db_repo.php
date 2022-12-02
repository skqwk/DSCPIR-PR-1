<?php
include_once 'crud_repo.php';
include_once '../application/domain/domain.php';

class LocationDBRepoImpl implements CrudRepo {

    private $db;

    public function __constructor($db) {
        $this->db = $db;
    }

    function readAll() {
        $query = "select id, name, latitude, longitude from location;";
        $stmt = db()->query($query);
        return $stmt;
    }

    function create(Domain $location) {
        $query = "insert into location(name, latitude, longitude) VALUES(?, ?, ?);";
        $stmt = db()->prepare($query);
        $stmt->bind_param("sdd", 
            $location->name, 
            $location->latitude, 
            $location->longitude);

        $stmt->execute();
        $result = db()->insert_id;
        return $result;
    }

    function readOne(int $id) {
        $query = "select id, id, name, latitude, longitude from location where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function update(int $id, Domain $location) {
        $query = "update location set name = ?, latitude = ?, longitude = ? where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("sddi", 
            $location->name, 
            $location->latitude, 
            $location->longitude, 
            $id
        );

        $stmt->execute();
        return $id;
    }

    function delete(int $id) {
        $query = "delete from location where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $id;
    }

}

?>