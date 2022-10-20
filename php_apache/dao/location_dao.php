<?php
include_once "../content/boot.php";


class LocationDAO {


    function readAll() {
        $query = "select id, name, latitude, longitude from location;";
        $stmt = db()->query($query);
        return $stmt;
    }

    function create(Location $location) {
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

    function update(int $id, Location $location) {
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