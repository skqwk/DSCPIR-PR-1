<?php

interface DocumentRepo {
    function findAllDocumentsByLogin($login);
    function loadDocument($folder, $key, $file);
}


?>