<?php

namespace UserNotification\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';
    protected $fillable = ['user_id', 'title', 'body', 'link', 'seen_at', 'archived_at'];
    protected $casts = ['seen_at' => 'datetime', 'archived_at' => 'datetime'];
}
