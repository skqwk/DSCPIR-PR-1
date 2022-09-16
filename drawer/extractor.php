<?php

function extract_props($num) {
    // figure   size    red         green       blue
    // 11       1111    11111111    11111111    11111111    
    $props = array();

    $props['blue'] = $num & 255;
    $num >>= 8;

    $props['green'] = $num & 255;
    $num >>= 8;

    $props['red'] = $num & 255;
    $num >>= 8;

    $props['size'] = ($num & 15) + 1;
    $num >>= 4;

    $props['figure'] = $num & 3;
    return $props;
}

?>