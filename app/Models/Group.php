<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Модель группы студентов
 */
class Group extends Model
{
    /**
     * {@inheritdoc}
     */
    protected $primaryKey = 'group_id';

    /**
     * {@inheritdoc}
     */
    protected $table = 'student_groups';

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'group_id');
    }
}