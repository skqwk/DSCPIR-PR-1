<?php
include_once 'api_exception.php';
class BadRequestException extends ApiException {
    public function __construct($message, Throwable $previous = null) {
        parent::__construct($message, 400, $previous);
    }
}
?>