<?php

namespace App\Api\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/15
 * Time: 11:17
 */
class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'is_third' => $user->is_third,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];
    }
}