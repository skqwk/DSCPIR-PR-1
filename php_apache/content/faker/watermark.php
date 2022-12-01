<?php

// https://www.php.net/manual/en/image.examples-watermark.php

function addWatermark($image) {
    $image1 = $image;
    $image2 = 'images/watermark.png';
    list($width, $height) = getimagesize($image2);

    $image1 = imagecreatefromstring(file_get_contents($image1));
    $image2 = imagecreatefromstring(file_get_contents($image2));

    imagecopy($image1, $image2, 40, 10, 0, 0, $width, $height);
    imagemergecopy();
    imagepng($image1, $image);
}