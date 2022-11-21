<?php
include_once 'theme.php';
include_once "boot.php";
$key = basename($_FILES['fileToUpload']['name']);
// $_FILES["fileToUpload"]["name"]

$bucket = $_SERVER['PHP_AUTH_USER'];

echo '<div><pre>';
$ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
if ($ext != "pdf") {
    echo "Вы попытались загрузить не pdf файл";
} else {
    try {
        $result = s3()->putObject([
            "Bucket" => $bucket,
            "Key" => $key,
            "Body" => "this is the body!",
            "SourceFile" => $_FILES['fileToUpload']['tmp_name'],
            "ContentType" => "application/pdf",
        ]);
        echo "Файл корректен и был успешно загружен.\n";
    } catch (Exception $e) {
            echo "Ошибка:\n".$e->getMessage()."\n";
    }
}
echo '</pre></div>';

?>

<a href="documents.php">К списку</a>