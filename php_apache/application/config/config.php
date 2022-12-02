<?php
require "../application/libraries/aws/aws-autoloader.php";
include_once "../application/repo/location_db_repo.php";
include_once "../application/repo/weather_report_db_repo.php";
include_once "../application/repo/user_db_repo.php";
include_once "../application/repo/user_mem_repo.php";
include_once "../application/repo/document_s3_repo.php";
date_default_timezone_set('America/Los_Angeles');

function db(): mysqli {
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
                "key" => getenv("MINIO_ROOT_USER"),
                "secret" => getenv("MINIO_ROOT_PASSWORD"),
            ],
        
        ]);
    }

    return $s3;
}

function weatherReportRepo(): CrudRepo {
    static $weatherReportRepo;
    if (!$weatherReportRepo) {
        $weatherReportRepo = new WeatherReportDBRepoImpl(db());
    }
    return $weatherReportRepo;
}

function locationRepo(): CrudRepo {
    static $locationRepo;
    if (!$locationRepo) {
        $locationRepo = new LocationDBRepoImpl(db());
    }
    return $locationRepo;
}

function userRepo(): UserRepo {
    static $userRepo;
    if (!$userRepo) {
        $userRepo = new UserMemRepoImpl();
        // $userRepo = new UserDBRepoImpl(db());
    }
    return $userRepo;
}

function documentRepo(): DocumentRepo {
    static $documentRepo;
    if (!$documentRepo) {
        $documentRepo = new DocumentS3RepoImpl(s3());
    }
    return $documentRepo;
}

?>