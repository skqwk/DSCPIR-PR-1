<?php
class FakeDataInstance {
    public string $name;
    public string $emoji;
    public float  $temperature;
    public float  $pressure;
    public string $date;
    public float $windSpeed;
    
    public function __construct(string $name, 
                                string $emoji,
                                float  $temperature,
                                float  $pressure,
                                DateTime $date,
                                float $windSpeed) {
        $this->name = $name;
        $this->emoji = $emoji;
        $this->temperature = $temperature;
        $this->pressure = $pressure;
        $this->date = $date->format('Y-m-d');
        $this->windSpeed = $windSpeed;
    }

}

?>