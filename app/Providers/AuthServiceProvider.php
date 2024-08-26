<?php

namespace App\Providers;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use App\Mail\EmailVerification;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot(): void
    {
        $this->registerPolicies();

        // Enable email verification for users
        VerifyEmailNotification::toMailUsing(function ($notifiable) {
            return (new EmailVerification($notifiable))
                        ->to($notifiable->email);
        });

        //
    }
}
