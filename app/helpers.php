<?php

if (!function_exists('isAdmin')) {
    function isAdmin($user = null): bool
    {
        $user = $user ?? auth()->user();

        if (!$user) {
            return false;
        }

        return $user->role && $user->role->name === 'admin';
    }
}