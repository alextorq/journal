<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель журнала
 */
class Journal extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $table = 'journal';

    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'journal_id';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'lesson_log_id',
        'user_id',
        'is_visited',
        'additional'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessonLog()
    {
        return $this->belongsTo(LessonLog::class, 'lesson_log_id', 'lesson_log_id');
    }

}