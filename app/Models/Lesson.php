<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель занятий
 */
class Lesson extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'lesson_id';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name'
    ];
}