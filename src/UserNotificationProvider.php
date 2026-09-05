<?php

namespace UserNotification;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class UserNotificationProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'UserNotificationViews');

        if ($this->app->runningInConsole()) {

            $this->commands([
                CreateAllowanceReminderCommand::class,
            ]);

            $this->app->booted(function () {

                $schedule = app(Schedule::class);

                $schedule
                    ->command('notification:allowance-reminder');
            });
        }
    }
}
