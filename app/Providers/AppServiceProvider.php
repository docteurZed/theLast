<?php

namespace App\Providers;

use App\Models\ParticipantMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use App\Notifications\Channels\CustomPushChannel;

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

        $this->app->make(ChannelManager::class)->extend('customPush', function ($app) {
            return new CustomPushChannel();
        });

        View::composer('participant.*', function ($view) {
            $messageCount = ParticipantMessage::where('receiver_id', Auth::user()->id)->where('is_read', false)->count();
            $notifCount = Auth::user()->unreadNotifications->count();

            $view->with([
                'messageCount' => $messageCount,
                'notifCount' => $notifCount
            ]);
        });
    }
}
