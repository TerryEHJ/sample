<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Models\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    // 只能删除自己的微博
    public function destory(User $user, Status $status)
    {
        return $user->id === $status->user_id;
    }
}
