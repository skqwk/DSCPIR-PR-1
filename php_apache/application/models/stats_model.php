<?php
include_once '../application/config/config.php';
include_once '../application/core/model.php';
require_once '../application/libraries/vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

class StatsModel extends Model {

    public function get_data() {
        return $this->generate_data();
    }

    public function get_images() {
        $images = array("PlotBar", "PlotGraph", "PlotPie");
        $result = array();
        foreach($images as $image) {
            $image_path = draw($image);
            addWatermark($image_path);
            $result[] = array(
                "path" => $image_path,
                "name" => $image
            );
        }
        return $result;
    }

    function generate_data() {
        $AMOUNT_ROWS = 50;
        $data = array();
        $emojis = array(
            '🌧️','☀️','☁️','⛅','🌩️'
        );
        $faker = Faker\Factory::create();
        $faker->addProvider(new Faker\Provider\ru_RU\Person($faker));
        $faker->addProvider(new Faker\Provider\ru_RU\Address($faker));
    
        for ($i = 0; $i < $AMOUNT_ROWS; $i++) {
            $row = new FakeDataInstance(
                $faker->address(),
                $emojis[$faker->numberBetween(0, count($emojis) - 1)],
                $faker->randomFloat(1, 20, 30),
                $faker->randomFloat(1, 740, 770),
                $faker->dateTimeInInterval('-4 month', '+5 days'),
                $faker->randomFloat(1, 0, 10),
            );
            $data[] = $row;
        }
        $jsonData = json_encode($data);
        file_put_contents('data.json', $jsonData);
        return $data;
    }


}

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


function getRawData() {
    $input = file_get_contents('data.json');
    return json_decode($input);
}

function getDayCount($data) {
    $dayCount = array();
    foreach($data as $row) {
        $weekday = $row->weekday;
        if (!isset($dayCount[$weekday])) {
            $dayCount[$weekday] = 0;
        }
        $dayCount[$weekday] += 1;
    }
    return $dayCount;
}



function getBloodTypeCount($data) {
    $bloodTypeCount = array();
    foreach($data as $row) {
        $weekday = $row->bloodType;
        if (!isset($bloodTypeCount[$bloodType])) {
            $bloodTypeCount[$bloodType] = 0;
        }
        $bloodTypeCount[$bloodType] += 1;
    }
    return $bloodTypeCount;
}

function getMountCount($data) {
    $count = array();
    foreach ($data as $row) {
        $value = $row->month;
        if(!isset($count[$value])) {
            $count[$value] = 0;
        }
        $count[$value] += 1;
    }
    return $count;
}

function getDateCount($data) {
    $dateCount = array();
    foreach($data as $row) {
        $date = $row->date;
        if (!isset($dateCount[$date])) {
            $dateCount[$date] = 0;
        }
        $dateCount[$date] += 1;
    }
    return $dateCount;
}

function getEmojiCount($data) {
    $emojiCount = array();
    foreach($data as $row) {
        $emoji = $row->emoji;
        if (!isset($emojiCount[$emoji])) {
            $dateCount[$emoji] = 0;
        }
        $emojiCount[$emoji] += 1;
    }
    return $emojiCount;
}

function getAverageTemperature($data) {
    $average = array();
    foreach($data as $row) {
        $date = $row->date;
        $temperature = $row->temperature;
        if(!isset($average[$date])) {
            $average[$date] = array(0, 0);
        }
        $average[$date][0] += $temperature;
        $average[$date][1] += 1;
    }

    foreach ($average as $key => $value) {
        $average[$key] = $average[$key][0] / $average[$key][1];
    }
    return $average;
}

function getAverageTemperatureAutoload() {
    return getAverageTemperature(getRawData());
}
function getLabelsAndValues($func) {
    $rawData = getRawData();
    $dayCount = $func($rawData);
    $labels = array_keys($dayCount);
    $values = array_values($dayCount);
    return array("labels" => $labels, "values" => $values);
}

function draw($func) {
    $func = 'draw' . $func;
    $image = $func();
    return $image;
}

function drawPlotBar() {
    $__width = 400;
    $__height = 300;
    $graph = new Graph\Graph($__width, $__height, 'auto');
    $graph->SetColor('aliceblue');
    $graph->title->Set('Weather Bar');

    $labelsAndValues = getLabelsAndValues('getEmojiCount');
    $labels = $labelsAndValues["labels"];
    $values = $labelsAndValues["values"];

    $graph->SetScale('textlin');

    $graph->xaxis->SetTickLabels(array_keys($labels));

    $barplot = new Plot\BarPlot($values);

    $graph->Add($barplot);
    
    $graph->Stroke('../images/plot_bar.png');

    return '../images/plot_bar.png';

}

function drawPlotGraph() {
    $data = getAverageTemperatureAutoload();
    $labelsAndValues = getLabelsAndValues('getAverageTemperature');
    $labels = $labelsAndValues["labels"];
    $values = $labelsAndValues["values"];

    $dates = array_keys($values);
    ksort($values);
    sort($labels);

    $width = count($labels) * 100; $height = 200;

    $graph = new Graph\Graph($width, $height);
    $graph->SetColor('aliceblue');
    $graph->SetBox(true);
    $graph->SetScale('intint',0,0,0,max($dates)-min($dates)+1);

    $graph->title->Set('Average Temperature');

    $graph->xaxis->title->Set('(dates)');

    $graph->yaxis->title->Set('(average temp)');
    $graph->xaxis->SetTickLabels($labels);

    $lineplot=new Plot\LinePlot($values);

    $graph->Add($lineplot);

    $graph->Stroke('../images/plot_graph.png');

    return '../images/plot_graph.png';
}

function drawPlotPie() {
    $graph = new Graph\PieGraph(400, 300);
    $graph->SetColor('aliceblue');
    $graph->title->Set("Date Amount Metrics");
    $graph->SetBox(true);

    $labelsAndValues = getLabelsAndValues('getDateCount');
    $labels = $labelsAndValues["labels"];
    $values = $labelsAndValues["values"];

    $pieplot = new Plot\PiePlot($values);
    $pieplot->ShowBorder();
    $pieplot->SetLabels($labels);

    $graph->Add($pieplot);

    $graph->Stroke("../images/plot_pie.png");

    return '../images/plot_pie.png';
}

function addWatermark($image) {
    $image1 = $image;
    $image2 = '../images/watermark.png';
    list($width, $height) = getimagesize($image2);

    $image1 = imagecreatefromstring(file_get_contents($image1));
    $image2 = imagecreatefromstring(file_get_contents($image2));

    imagecopy($image1, $image2, 40, 10, 0, 0, $width, $height);
    imagepng($image1, $image);
}

?>