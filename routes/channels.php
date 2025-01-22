<?php

Broadcast::channel('order-notifications', function ($user) {
    return $user->role === 'admin';
});