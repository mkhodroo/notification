<?php

namespace UserNotification;

use Illuminate\Support\ServiceProvider;

class UserNotificationProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'UserNotificationViews');
    }
}
