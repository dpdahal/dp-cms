<?php

namespace App\Repositories\Account\Admin;

interface AdminInterface
{

    public function getAccountTypes();

    public function getCountry();

    public function get();

    public function getById($id);

    public function store($data);

    public function update($data, $id);

    public function delete($id);

    public function getAllRoles();


}
