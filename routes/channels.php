<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('private-chat.{username1}.{username2}', function ($user, $username1, $username2) {
    return ($user->username === $username1) || ($user->username === $username2);
});



Broadcast::routes(['middleware' => ['web', 'auth']]);
