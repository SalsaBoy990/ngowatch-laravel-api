<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Change the url structure of the password reset link sent out in emails
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return config('app.url')."/api/v1/password/reset?token=$token&email={$notifiable->getEmailForPasswordReset()}";
        });
    }
}
