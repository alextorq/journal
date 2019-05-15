<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель ролей
 */
class Schedule extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'schedule_id';

    /**
     * {@inheritdoc}
     */
    protected $table = 'schedule';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'group_id',
        'lesson_id',
        'dateFrom',
        'dateTo',
        'user_id',
        'day',
        'lesson_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne(Group::class, 'group_id', 'group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lesson()
    {
        return $this->hasOne(Lesson::class, 'lesson_id', 'lesson_id');
    }

    /**
     * Скоуп по ID пользователя
     *
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeByUserId(Builder $query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Скоуп по дню
     *
     * @param Builder $query
     * @param string $day
     * @return Builder
     */
    public function scopeByDay(Builder $query, string $day)
    {
        return $query->where('day', $day);
    }
}