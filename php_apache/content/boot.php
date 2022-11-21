<?php
require "aws/aws-autoloader.php";
date_default_timezone_set('America/Los_Angeles');

// Простой способ сделать глобально доступным подключение в БД
function db(): mysqli
{
    static $mysqli;

    if (!$mysqli) {
        $mysqli = new mysqli(getenv("HOST"), getenv("USERNAME"), getenv("PASSWORD"), getenv("NAME"));
    }

    return $mysqli;
}

function s3(): Aws\S3\S3Client {

    static $s3;

    if (!$s3) {
        $s3 = new Aws\S3\S3Client([
            "version" => "latest",
            "region" => "us-east-1",
            "endpoint" => getenv("MINIO_URL"),
            "use_path_style_endpoint" => true,
            "credentials" => [
                // get this from `cat run.sh`
                "key" => getenv("MINIO_ROOT_USER"),
                "secret" => getenv("MINIO_ROOT_PASSWORD"),
            ],
        
        ]);
    }

    return $s3;

}


function flash(?string $message = null)
{
    if ($message) {
        $_SESSION['flash'] = $message;
    } else {
        if (!empty($_SESSION['flash'])) { ?>
          <div class="alert alert-danger mb-3">
              <?=$_SESSION['flash']?>
          </div>
        <?php }
        unset($_SESSION['flash']);
    }
}
?>