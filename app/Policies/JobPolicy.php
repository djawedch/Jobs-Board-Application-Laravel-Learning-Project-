<?php

namespace App\Policies;

use App\Models\{User, Job};

class JobPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Job $job): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isEmployer();
    }

    public function update(User $user, Job $job): bool
    {
        return $user->ownsJob($job);
    }

    public function delete(User $user, Job $job): bool
    {
        return $user->ownsJob($job);
    }
}
