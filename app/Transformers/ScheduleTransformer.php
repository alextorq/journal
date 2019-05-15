<?php

namespace App\Transformers;

use App\Models\Schedule;
use Illuminate\Support\Collection;

/**
 * Трансформер для расписания
 */
class ScheduleTransformer
{
    /**
     * Приводим расписание к нужному виду
     *
     * @param Collection $collection
     * @return array
     */
    public function transform(Collection $collection): array
    {
        $result['data'] = [
            'monday'    => [],
            'tuesday'   => [],
            'wednesday' => [],
            'thursday'  => [],
            'friday'    => [],
            'saturday'  => []
        ];

        $collection->each(function (Schedule $schedule) use (&$result) {
            $result['data'][$schedule->day][] = [
                'group'     => $schedule->group->name ?? '',
                'lesson'    => $schedule->lesson->name ?? '',
                'time'      => substr($schedule->dateFrom, 0, -3) . ' - ' . substr($schedule->dateTo, 0, -3)
            ];
        });

        return $result;
    }
}