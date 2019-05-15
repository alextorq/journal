<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель "зачетной книжки"
 */
class RecordBook extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'record_book_id';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'lesson_id',
        'user_id',
        'mark'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id', 'lesson_id');
    }
}