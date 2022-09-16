<?php
function validate() {
    return 
        array_key_exists('num', $_GET) 
        and is_numeric($_GET['num']) 
        and $_GET['num'] <= 1073741824 
        and $_GET['num'] >= 0;
}

?>