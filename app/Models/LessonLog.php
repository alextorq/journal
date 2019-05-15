<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Факт проведения занятия
 */
class LessonLog extends Model
{
    protected $primaryKey = 'lesson_log_id';

    protected $fillable = [
        'schedule_id',
        'date'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'schedule_id');
    }
}