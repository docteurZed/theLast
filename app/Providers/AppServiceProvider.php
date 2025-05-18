<?php

namespace App\Providers;

use App\Models\ParticipantMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);

        View::composer('participant.*', function ($view) {
            $unreadMessages = ParticipantMessage::where('receiver_id', Auth::user()->id)->where('is_read', false)->get();

            $view->with([
                'unreadMessages' => $unreadMessages,
            ]);
        });
    }
}
