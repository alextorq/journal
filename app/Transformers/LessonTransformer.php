<?php

namespace App\Transformers;

use App\Models\Lesson;
use League\Fractal\TransformerAbstract;

/**
 * Трансформер для дисциалин
 */
class LessonTransformer extends TransformerAbstract
{
    public function transform(Lesson $lesson)
    {
        return [
            'lesson_id' => $lesson->getKey(),
            'name' => $lesson->name
        ];
    }
}