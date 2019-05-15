<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

class UsersController
{
    /**
     * @var Manager
     */
    private $fractal;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Получение списка преподавателей
     *
     * @param UserTransformer $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeachers(UserTransformer $transformer)
    {
        $teachers = User::teachers()->get();

        $collection = new Collection($teachers, $transformer);

        return response()->json($this->fractal->createData($collection)->toArray());
    }
}