<?php

if (!function_exists('has_permission')) {
    /**
     * Check if the logged-in user has a specific permission.
     * For now, Admin (role_id=1) has all permissions.
     */
    function has_permission(string $permission): bool
    {
        if (!session()->get('logged_in')) {
            return false;
        }

        $roleId = session()->get('role_id');

        // Admin has all permissions
        if ($roleId == 1) {
            return true;
        }

        $permisos = session()->get('permisos') ?? [];

        return in_array($permission, $permisos);
    }
}

if (!function_exists('user_name')) {
    function user_name(): string
    {
        return session()->get('user_name') ?? 'Usuario';
    }
}

if (!function_exists('user_email')) {
    function user_email(): string
    {
        return session()->get('user_email') ?? '';
    }
}

if (!function_exists('role_name')) {
    function role_name(): string
    {
        return session()->get('role_name') ?? '';
    }
}
