<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\StudentInformationTransformer;
use App\Transformers\StudentsTransformer;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

/**
 * Контроллер страницы списка студентов
 */
class StudentsController extends \Illuminate\Routing\Controller
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
     * Главная страница со студентами
     * @param StudentsTransformer $studentsTransformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(StudentsTransformer $studentsTransformer)
    {
        $students = User::students()->with('group')->paginate(10);

        $collection = new Collection($students, $studentsTransformer);
        $collection->setPaginator(new IlluminatePaginatorAdapter($students));

        return response()->json($this->fractal->createData($collection)->toArray());
    }

    /**
     * Информация по одному студенту
     *
     * @param User $user
     * @param StudentInformationTransformer $transformer
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user, StudentInformationTransformer $transformer)
    {
        $user->load(['group', 'recordBooks.lessons', 'journals.lessonLog.schedule.lesson']);

        $data = $transformer->transform($user);

        return response()->json($data);
    }
}