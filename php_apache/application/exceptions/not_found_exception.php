<?php
include_once 'api_exception.php';
class NotFoundException extends ApiException {
    public function __construct($message, Throwable $previous = null) {
        parent::__construct($message, 404, $previous);
    }
}
?>