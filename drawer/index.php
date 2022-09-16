<?php

include 'extractor.php';
include 'validator.php';

function draw($size, $figure, $im, $color) {
    $triangle = array(
        $size / 2, 5, 
        5, $size - 5,
        $size - 5, $size - 5
    );

    $rhombus = array(
        $size / 2, 5,
        $size - 5, $size / 2,
        $size / 2, $size - 5,
        5, $size / 2,
    );

    switch ($figure) {
        case 0: // 0b00 - square
            imagefilledrectangle($im, 5, 5, $size - 5, $size - 5, $color);
            break;
        case 1: // 0b01 - circle
            imagefilledellipse($im, $size / 2, $size / 2, $size - 5, $size - 5, $color);
            break;
        case 2: // 0b10 - triangle
            imagefilledpolygon($im, $triangle, 3, $color);
            break;
        case 3: // 0b10 - rhombus
            imagefilledpolygon($im, $rhombus, 4, $color);
            break;
    }
}

if (validate()) {
    $num = $_GET['num'];
    $props = extract_props($num);
    $size = $props['size'] * 70;
    $im = imagecreate($size, $size);
    $background = imagecolorallocate($im, 255, 255, 255);
    $color = imagecolorallocate($im, $props["red"], $props["green"], $props["blue"]);

    draw($size, $props['figure'], $im, $color);

    header("Content-type: image/png");

    imagepng($im);
   
    imagedestroy($im);


} else {
    echo "Bad Request";
    http_response_code(400);
}

?>