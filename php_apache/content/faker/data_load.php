<?php

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

function getDayBloodTuple() {
    $data = getRawData();
    $blood_array = array();
    $day_array = array();
    $blood_keys = array();
    $day_keys = array();
    foreach ($data as $row) {
        if (!in_array($row->weekday, $day_keys)) {
            $day_keys[] = $row->weekday;
        }
        if (!in_array($row->bloodType, $blood_keys)) {
            $blood_keys[] =$row->bloodType;
        }
    }
    $day_keys = array_flip($day_keys);
    $blood_keys = array_flip($blood_keys);
    foreach ($data as $row) {
        $day_array[] = $day_keys[$row->weekday];
        $blood_array[] = $blood_keys[$row->bloodType];
    }
    return array(
        "day" => $day_array,
        "blood" => $blood_array,
        "day_keys" => array_values($day_keys),
        "blood_keys" => array_values($blood_keys)
    );
}

function getLabelsAndValues($func) {
    $rawData = getRawData();
    $dayCount = $func($rawData);
    $labels = array_keys($dayCount);
    $values = array_values($dayCount);
    return array("labels" => $labels, "values" => $values);
}













?>