<?php
include_once 'domain.php';

class WeatherReport extends Domain {
    public int $id;
    public ?string $timestamp;
    public float $temperature;
    public float $windSpeed;
    public float $pressure;
}

?>