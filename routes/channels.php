<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('messages.{userId}', function ($user = null, $userId) {
    // For testing, allow any user with the same `userId` from local storage
    return true; // This skips authentication
});
