<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::model('contactId', Contact::class);
        Route::model('appointmentId', Appointment::class);
    }
}
