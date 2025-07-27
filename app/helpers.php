<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('dynamic_route')) {
    function dynamic_route(array|string $group, string $name, array $params = []): string {
        $segments = [];

        if (!auth()->check()) {
            $segments[] = 'guest';
        }

        if (is_array($group)) {
            $segments = array_merge($segments, $group);
        } else {
            $segments[] = $group;
        }
        
        $segments[] = $name;

        return route(implode('.', $segments), $params);
    }
}