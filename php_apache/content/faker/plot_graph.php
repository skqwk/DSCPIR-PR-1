<?php
require_once '../../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';


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

    $graph->Stroke('images/plot_graph.png');

    return 'images/plot_graph.png';
}
