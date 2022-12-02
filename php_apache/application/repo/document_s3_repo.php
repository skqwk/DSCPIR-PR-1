<?php

include_once 'document_repo.php';

class DocumentS3RepoImpl implements DocumentRepo {

    private $s3;

    public function __construct($s3) {
        $this->s3 = $s3;
    }

    function findAllDocumentsByLogin($login) {

        if(!$this->s3->doesBucketExist($login)) {
            $this->s3->createBucket(array(
                'ACL' => 'public-read',
                'Bucket' => $login 
            ));
        }        
        $results = $this->s3->getPaginator('ListObjects', [
            'Bucket' => $login
        ]);
        return $results;

    }
    function loadDocument($folder, $key, $file) {
        $result = $this->s3->putObject([
            "Bucket" => $folder,
            "Key" => $key,
            "Body" => "this is the body!",
            "SourceFile" => $file,
            "ContentType" => "application/pdf",
        ]);
        return $result;
    }
}


?>