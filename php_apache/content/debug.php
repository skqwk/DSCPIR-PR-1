<?php
require_once 'boot.php';
$login = $_SERVER['PHP_AUTH_USER'];
$policy = s3()->getBucketAcl([
    'Bucket' => $login,
]);

echo $policy;

?>