<?php

namespace UserNotification\Commands;

use Illuminate\Console\Command;
use UserNotification\Services\NotificationService;

class CreateAllowanceReminderCommand extends Command
{
    protected $signature = 'notification:allowance-reminder';

    protected $description = 'ایجاد یادآوری ماهانه جهت صفر کردن لیست مساعده‌ها';

    public function handle(NotificationService $service): int
    {
        // شناسه کاربر مورد نظر
        $userId = 1;

        $service->create(
            [$userId],
            'یادآوری مساعده‌ها',
            'یادآوری جهت صفر کردن لیست مساعده‌ها'
        );

        $this->info('Allowance reminder notification created successfully.');

        return self::SUCCESS;
    }
}