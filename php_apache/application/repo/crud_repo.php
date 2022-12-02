<?php

include_once '../application/domain/domain.php';

interface CrudRepo {
    function readAll();
    function create(Domain $domain);
    function update(int $id, Domain $domain);
    function delete(int $id);
    function readOne(int $id);
}


?>