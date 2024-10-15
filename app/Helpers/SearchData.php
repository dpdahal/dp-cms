<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SearchData
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function filter_by_criteria($criteria = 'search', $searchAbleFiled = []): Builder
    {
        $columns = $this->model->getFillable();
        $query = $this->model->query();
        foreach ($columns as $column) {
            if (in_array($column, $searchAbleFiled)) {
                $query->orWhere($column, 'like', '%' . $criteria . '%');
            }
        }
        return $query;
    }

}
