<?php
namespace App\Contracts;

interface MainRepositoryInterface {

    public function all($columns = array('*'));

    public function paginate($perPage = 10, $columns = array('*'));

    public function create(array $data);

}
