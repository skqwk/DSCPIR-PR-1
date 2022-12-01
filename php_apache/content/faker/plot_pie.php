<?php
require_once '../../vendor/autoload.php';

use Amenadiel\JpGraph\Graph;
use Amenadiel\JpGraph\Plot;

require_once 'data_load.php';

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

    $graph->Stroke("images/plot_pie.png");

    return 'images/plot_pie.png';
}