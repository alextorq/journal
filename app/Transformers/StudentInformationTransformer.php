<?php

namespace App\Transformers;

use App\Models\Journal;
use App\Models\User;

/**
 * Полная информация по студенту
 */
class StudentInformationTransformer
{
    public function transform(User $user): array
    {
        $recordBookData = [];

        foreach ($user->recordBooks as $recordBook) {
            $recordBookData[] = [
                'name' => $recordBook->lessons->name,
                'mark' => $recordBook->mark
            ];
        }

        $visitStats = [];

        foreach ($user->journals as $journal) {
            $this->counter($journal->lessonLog->schedule->lesson_id, $visitStats, $journal);
        }

        return [
            'user_id'       => $user->getKey(),
            'first_name'    => $user->first_name,
            'last_name'     => $user->last_name,
            'middle_name'   => $user->middle_name ?? '',
            'full_name'     => sprintf(
                '%s %s %s',
                $user->last_name,
                $user->first_name,
                $user->middle_name ?? ''
            ),
            'group'         => $user->group->name,
            'recordBook' => $recordBookData,
            'visitLog' => array_values($visitStats)
        ];
    }

    /**
     * Подсчет посещаяемости
     *
     * @param int $key
     * @param array $array
     * @param Journal $journal
     */
    protected function counter(int $key, array &$array, Journal $journal)
    {
        $visited = $array[$key]['visited'] ?? 0;
        $lessonCounter = $array[$key]['lessons_count'] ?? 0;

        $array[$key] = [
            'name' => $journal->lessonLog->schedule->lesson->name,
            'visited' => $journal->is_visited ? ++$visited : $visited,
            'lessons_count' => ++$lessonCounter,
            'percentOfVisitedLessons' => round($visited / $lessonCounter * 100) . '%'
        ];
    }
}