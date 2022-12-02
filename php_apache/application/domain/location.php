<?php
include_once 'domain.php';

class Location extends Domain {
    public int $id;
    public ?string $name;
    public float $latitude;
    public float $longitude;
}

?>