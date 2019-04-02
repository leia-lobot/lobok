<?php

namespace App\Role;

class UserRole
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_MANAGER = 'ROLE_MANAGER';
    const ROLE_EMPLOYER = 'ROLE_EMPLOYER';
    const ROLE_EMPLOYEE = 'ROLE_EMPLOYEE';
    const ROLE_UNEMPLOYED = 'ROLE_UNEMPLOYED';

    protected static $roleHierarchy = [
        self::ROLE_ADMIN => ['*'],
        self::ROLE_MANAGER => [
            self::ROLE_EMPLOYER,
            self::ROLE_EMPLOYEE,
            self::ROLE_UNEMPLOYED,
        ],
        self::ROLE_EMPLOYER => [
            self::ROLE_EMPLOYEE,
            self::ROLE_UNEMPLOYED,
        ],
        self::ROLE_EMPLOYEE => [
            self::ROLE_UNEMPLOYED,
        ],
        self::ROLE_UNEMPLOYED => [],
    ];

    public static function getAllowedRoles(string $role)
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    public static function getRoleList()
    {
        return [
            self::ROLE_ADMIN => 'Admin',
            self::ROLE_MANAGER => 'Manager',
            self::ROLE_EMPLOYER => 'Employer',
            self::ROLE_EMPLOYEE => 'Employee',
            self::ROLE_UNEMPLOYED => 'Unemployed',
        ];
    }
}
