<?php
include_once '../application/details/boot.php';
include_once '../application/core/model.php';
class DocumentsModel extends Model {

    public function get_loaded_documents() {
        $login = $_SERVER['PHP_AUTH_USER'];
        if(!s3()->doesBucketExist($login)) {
            s3()->createBucket(array(
                'ACL' => 'public-read',
                'Bucket' => $login 
            ));
        }        
        $results = s3()->getPaginator('ListObjects', [
            'Bucket' => $login
        ]);
        return $results;
    }

    public function load_documents() {
        $key = basename($_FILES['fileToUpload']['name']);
        $bucket = $_SERVER['PHP_AUTH_USER'];
        $ext = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        if ($ext != "pdf") {
            return "Вы попытались загрузить не pdf файл";
        } else {
            try {
                $result = s3()->putObject([
                    "Bucket" => $bucket,
                    "Key" => $key,
                    "Body" => "this is the body!",
                    "SourceFile" => $_FILES['fileToUpload']['tmp_name'],
                    "ContentType" => "application/pdf",
                ]);
                return "Файл корректен и был успешно загружен.\n";
            } catch (Exception $e) {
                    return "Ошибка:\n".$e->getMessage()."\n";
            }
        }
    }


}
?>