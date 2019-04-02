<?php

namespace App\Role;

use App\User;

class RoleChecker
{
    public function check(User $user, string $role)
    {
        // Admin has everything
        if ($user->hasRole(UserRole::ROLE_ADMIN)) {
            return true;
        } elseif ($user->hasRole(UserRole::ROLE_MANAGER)) {
            $managerRoles = UserRole::getAllowedRoles(UserRole::ROLE_MANAGER);

            if (in_array($role, $managerRoles)) {
                return true;
            }
        }

        return $user->hasRole($role);
    }
}
