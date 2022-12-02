<?php

include_once '../application/domain/domain.php';
include_once '../application/repo/crud_repo.php';
include_once "../application/exceptions/not_found_exception.php";

abstract class AbstractService {
    protected CrudRepo $crudRepo;
    protected string $singular_domain_name;
    protected string $plural_domain_name;

    public function __construct(CrudRepo $crudRepo, 
                                $singular_domain_name,
                                $plural_domain_name) {
        $this->crudRepo = $crudRepo;
        $this->singular_domain_name = $singular_domain_name;
        $this->plural_domain_name = $plural_domain_name;
    }

    function readAll() {
        $query_result = $this->crudRepo->readAll();
        $objects = array($this->plural_domain_name => array());
        foreach($query_result as $domain) {
            $domain_obj = $this->format($domain);
            $objects[ $this->plural_domain_name][] = $domain_obj;
        }
        return $objects;
    }

    function create(Domain $domain) {
        $created_id = $this->crudRepo->create($domain);
        return $this->readOne($created_id);
    }

    function update(int $id, Domain $domain) {
        $this->readOne($id);
        $updatedId = $this->crudRepo->update($id, $domain);
        return $this->readOne($updatedId);
    }

    function delete(int $id) {
        $this->readOne($id);
        $deletedId = $this->crudRepo->delete($id);
        return array("message" => $this->singular_domain_name . " with id = ".$id." is deleted");
    }

    function readOne(int $id) {
        $domain = $this->crudRepo->readOne($id);
        if (is_null($domain)) {
            throw new NotFoundException($this->singular_domain_name ." with id = ".$id." not found");
        }
        $domain_obj = $this->format($domain);
        return array($this->singular_domain_name => $domain_obj);
    }

    abstract protected function format($domain);

}






?>