<?php

    include_once "../application/dao/location_dao.php";
    class LocationService {

        private LocationDAO $dao;

        public function __construct() {
            $this->dao = new LocationDAO();
        }

        function readAll() {
            $query_result = $this->dao->readAll();
            $locations = array("locations" => array());
            foreach($query_result as $location) {
                $location_obj = $this->format($location);
                $locations["locations"][] = $location_obj;
            }
            return $locations;
        }

        function create(Location $location) {
            $created_id = $this->dao->create($location);
            return $this->readOne($created_id);
        }

        function update(int $id, Location $location) {
            $this->readOne($id);
            $updatedId = $this->dao->update($id, $location);
            return $this->readOne($updatedId);
        }

        function delete(int $id) {
            $this->readOne($id);
            $deletedId = $this->dao->delete($id);
            return array("message" => "Location with id = ".$id." is deleted");
        }

        function readOne(int $id) {
            $location = $this->dao->readOne($id);
            if (is_null($location)) {
                throw new Exception("Location with id = ".$id." not found");
            }
            $location_obj = $this->format($location);
            return array("location" => $location_obj);
        }

        function format($location) {
            return array(
                "id" => $location["id"],
                "name" => $location["name"],
                "latitude" => $location["latitude"],
                "longitude" => $location["longitude"]
            );
        }


    }



?>