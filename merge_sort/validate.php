<?php

function exclude_or_throw($str_nums) {
    try {
        $nums = explode(",", $str_nums);
        foreach($nums as $num) {
            if (!is_numeric($num)) {
                throw new Exception();
            }
        }

        return $nums;
    } catch (Exception $ex) {
        http_response_code(400);
        echo "Bad Request";
    }
}



?>