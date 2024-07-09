<?php

namespace App\Policies;

use App\Models\Despesa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DespesaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id;
    }

    public function update(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id;
    }

    public function delete(User $user, Despesa $despesa)
    {
        return $user->id === $despesa->user_id;
    }
}
