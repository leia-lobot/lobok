<?php

namespace App\Traits;

trait HasRole
{

    public function initializeHasRoleTrait(): void
    {

        $model->casts = array_merge($model->casts, ['roles' => 'array']);
    }

    public function addRole(string $role)
    {
        $roles = $this->getRoles();
        $roles[] = $role;

        $roles = array_unique($roles);
        $this->setRoles($roles);

        return $this;
    }

    public function setRoles(array $roles)
    {
        $this->setAttribute('roles', $roles);

        return $this;
    }

    public function hasRole($roles)
    {
        $currentRoles = $this->getRoles();

        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (!in_array($role, $currentRoles)) {
                    return false;
                }
            }
        } else {
            if (!in_array($roles, $currentRoles)) {
                return false;
            }
        }

        return true;
    }

    public function getRoles()
    {
        $roles = $this->getAttribute('roles');

        if (is_null($roles)) {
            $roles = [];
        }

        return $roles;
    }
}
