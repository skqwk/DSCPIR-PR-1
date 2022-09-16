<html lang="en">
<head>
<title>Merge Sort</title>
</head>
<body>
<?php

include 'merge_sort.php';
include 'validate.php';
if (array_key_exists('nums', $_GET)) {
    $str_nums = $_GET['nums'];
    $nums = exclude_or_throw($str_nums);
    if ($nums !== NULL) {
        $nums = merge_sort($nums);
        foreach($nums as $num) {
            echo $num . " ";
        }
    }
}
else {
    echo "Bad Request";
    http_response_code(400);
}

?>
</body>
</html>