<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Трансформер для преподавателей
 */
class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'user_id' => $user->getKey(),
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'middle_name' => $user->middle_name,
            'science_degree' => $user->science_degree
        ];
    }
}