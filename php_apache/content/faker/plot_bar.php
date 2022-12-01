<?php
require_once '../../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

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
    
    $graph->Stroke('images/plot_bar.png');

    return 'images/plot_bar.png';

}