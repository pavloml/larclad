<?php

namespace App\Providers;

use App\Events\EmailUpdated;
use App\Events\FailedLogin;
use App\Events\NewAbuseReport;
use App\Events\NewMessage;
use App\Events\PasswordUpdated;
use App\Events\ProfileUpdated;
use App\Events\SuccessfulLogin;
use App\Listeners\AbuseReportListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\PasswordReset;
use App\Listeners\EmailUpdateListener;
use App\Listeners\FailedLoginListener;
use App\Listeners\NewMessageListener;
use App\Listeners\PasswordUpdateListener;
use App\Listeners\ProfileUpdateListener;
use App\Listeners\SuccessfulLoginListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SuccessfulLoginListener::class,
        ],
        PasswordUpdated::class => [
            PasswordUpdateListener::class,
        ],
        ProfileUpdated::class => [
            ProfileUpdateListener::class,
        ],
        EmailUpdated::class => [
            EmailUpdateListener::class,
        ],
        SuccessfulLogin::class => [
            SuccessfulLoginListener::class,
        ],
        FailedLogin::class => [
            FailedLoginListener::class,
        ],
        NewMessage::class => [
            NewMessageListener::class,
        ],
        NewAbuseReport::class => [
            AbuseReportListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
