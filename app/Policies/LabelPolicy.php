<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;

class LabelPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Label $label): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, Label $label): bool
    {
        return $user !== null;
    }

    public function delete(User $user, Label $label): bool
    {
        return $user !== null;
    }
}
