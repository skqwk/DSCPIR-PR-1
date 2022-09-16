<?php

function merge_sort(&$nums) {
    __sort($nums, 0, count($nums) - 1);
    return $nums;
}

function merge(&$nums, $left, $mid, $right) {
    $len1 = $mid - $left + 1;
    $len2 = $right - $mid;

    $L = array(); $R = array();

    for ($i = 0; $i < $len1; $i++) {
        $L[$i] = $nums[$left + $i];
    }
    
    for ($i = 0; $i < $len2; $i++) {
        $R[$i] = $nums[$mid + $i + 1];
    }

    $i = $j = 0;
    $k = $left;
    while($i < $len1 && $j < $len2) {
        if ($L[$i] <= $R[$j]) {
            $nums[$k] = $L[$i]; $i++;
        } else {
            $nums[$k] = $R[$j]; $j++;
        }
        $k++;
    }

    while($i < $len1) {
        $nums[$k] = $L[$i];
        $i++; $k++;
    }
    while($j < $len2) {
        $nums[$k] = $R[$j];
        $j++; $k++;
    }
}

function __sort(&$nums, $left, $right) {
    if ($left < $right) {
        $mid = $left + (int) (($right - $left) / 2);
        __sort($nums, $left, $mid);
        __sort($nums, $mid + 1, $right);
        merge($nums, $left, $mid, $right);
    }
}

?>