<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class NotificationCustom extends Model
{
    use SoftDeletes, Auditable, HasFactory; 
    use HasTranslations;

    public $translatable = ['title', 'description'];
    public $table = 'notification_customs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'notification_type_id',
        'title',
        'description',
        'link',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function notification_type()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id');
    }

    public function users()
    {
        return $this->hasMany(Notification::class, 'notification_custom_id');
    }
}