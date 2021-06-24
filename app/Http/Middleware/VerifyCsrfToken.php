<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'stripe/*',
        'fetchSubGroup',
        'fetchField',
        'follow_it',
        'unfollow_it',
        'searchUser',
        'testing',
        'delete_tweet_id',
        'searchUserAdmin',
        'notificationU',
        'messagesU',
        'messagesPage',
        'sendMsg',
        'submessagesPage',
        'chatsearchUser',
        'update_msg_count',
    ];
}
