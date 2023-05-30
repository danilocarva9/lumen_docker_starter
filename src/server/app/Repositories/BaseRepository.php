<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    abstract public function getModel(): Model;

    public function findBy(array $attributes, string $compareType = '=')
    {
       return $this->findByParams($attributes, $compareType)->first();
    }

    public function findByOrCreate(string $attribute, int $value, array $request)
    {
        $model = $this->getModel()->where($attribute, '=', $value)->first();
        if(is_null($model)){
            return $this->create($request);
        }
        return $this->updateBy($request, $model->id);
    }

    public function updateBy(array $params, int $id): Model
    {
        return tap($this->getModel()->findOrFail($id))->updateOrFail($params);
    }

    public function create(array $data): Model
    {
        return $this->getModel()->create($data);
    }


     /**
     * Build a query base
     *
     * @param array  $params
     * @param string $defaultCompareType
     * @return Model|Builder
     */
    private function findByParams(array $params, string $defaultCompareType = '=')
    {
        /** @var Builder $query */
        $query = $this->getModel();
        foreach ($params as $param) {
            $compareType = count($param) === 2 ? $defaultCompareType : $param[2];
            if (mb_strtoupper($compareType) === 'IN') {
                $query = $query->whereIn($param[0], $param[1]);
            } else {
                $query = $query->where($param[0], $compareType, $param[1]);
            }
        }
        return $query;
    }

}
