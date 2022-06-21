<?php
namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectCoditions($coditions)
    {
        $coditions = explode(';', $coditions);

        foreach ($coditions as $item) {
            [$key, $operator, $value] = explode(':', $item);
            $this->model = $this->model->where($key, $operator, $value);
        }
    }

    public function selectFilter($filters)
    {
        $this->model = $this->model->selectRaw($filters);
    }

    public function getResults()
    {
        return $this->model;
    }
}
