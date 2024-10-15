<?php

namespace App\Repositories\Team;

use App\Models\MemberType\MemberType;
use App\Models\Team\Team;
use App\Models\User\AccountType;
use App\Models\User\User;

class TeamRepository implements TeamInterface
{
    private $model;

    public function __construct(Team $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function insert($data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
        return $this->model->find($id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getOnlyAdminData()
    {
        $accountTypes = AccountType::first();
        return User::where("account_type_id", "=", $accountTypes->id)->get();
    }

    public function getMemberTypes()
    {
        return MemberType::all();

    }
}
