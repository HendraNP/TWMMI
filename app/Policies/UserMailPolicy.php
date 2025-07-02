<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Filament\Facades\Filament;
use App\Models\UserMail;

class UserMailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array(Filament::auth()->user()?->user_type, ['marketing', 'manager','admin']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return in_array(Filament::auth()->user()?->user_type, ['marketing', 'manager','admin']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserMail $model): bool
    {
        return in_array(Filament::auth()->user()?->user_type, ['marketing', 'manager','admin']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserMail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
