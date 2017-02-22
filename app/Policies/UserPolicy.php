<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    // 只能修改自己资料
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    // 只有管理员能删除用户，且不能删除自己
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
