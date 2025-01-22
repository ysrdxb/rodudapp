<?php

if (!function_exists('getStatusColor')) {
    function getStatusColor(string $status): string
    {
        return match ($status) {
            'Pending' => 'badge-warning',
            'In Progress' => 'badge-info',
            'Delivered' => 'badge-success',
            default => 'badge-secondary',
        };
    }    
}
