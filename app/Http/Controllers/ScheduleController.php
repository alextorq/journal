<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Schedule;
use App\Models\User;
use App\Transformers\LessonTransformer;
use App\Transformers\ScheduleTransformer;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use League\Fractal\Manager;

/**
 * Расписаие
 */
class ScheduleController
{
    /**
     * @var Manager
     */
    private $fractal;

    /**
     * @var LessonTransformer
     */
    private $lessonTransformer;

    /**
     * @var UserTransformer
     */
    private $userTransformer;

    /**
     * @var ScheduleTransformer
     */
    private $scheduleTransformer;

    public function __construct(
        Manager $fractal,
        LessonTransformer $lessonTransformer,
        UserTransformer $userTransformer,
        ScheduleTransformer $scheduleTransformer
    ) {

        $this->fractal = $fractal;
        $this->lessonTransformer = $lessonTransformer;
        $this->userTransformer = $userTransformer;
        $this->scheduleTransformer = $scheduleTransformer;
    }

    /**
     * Расписание
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $teachers = User::where('role_id', 1)->get();
        $lessons = Lesson::all();
        $groups = Group::all();

        return response()->json([
            'data' => [
                'lessons'   => $lessons,
                'teachers'  => $teachers,
                'groups'    => $groups
            ]
        ]);
    }

    /**
     * Получение расписание конкретного пользователя
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchedule(User $user)
    {
        $schedule = $user->schedule()->with(['group', 'lesson'])->orderBy('dateFrom')->get();

        $result = $this->scheduleTransformer->transform($schedule);

        return response()->json($result);
    }

    /**
     * Добавляет расписание
     *
     * @param ScheduleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ScheduleRequest $request)
    {
        Schedule::create($request->all());

        return $this->index();
    }

    /**
     * Получение расписания на конкретный день
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getScheduleByUserAndDayOfTheWeek(Request $request)
    {
        $schedule = Schedule::byUserId($request->get('user'))->byDay($request->get('day'))->with(['group.users', 'lesson'])->get();

        return response()->json(['data' => ['test']]);
    }
}