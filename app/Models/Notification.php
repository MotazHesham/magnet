<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';

    protected $dates = [
        'read_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'data',
        'read_at',
        'notification_type_id',
        'notification_custom_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function notifiable()
    {
        return $this->morphTo();
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getReadAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setReadAtAttribute($value)
    {
        $this->attributes['read_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function notification_type()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id');
    }
    public function notification_custom()
    {
        return $this->belongsTo(NotificationCustom::class, 'notification_custom_id');
    }
}
