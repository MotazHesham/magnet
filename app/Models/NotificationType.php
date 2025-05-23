<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class NotificationType extends Model
{
    use SoftDeletes, Auditable, HasFactory;
    use HasTranslations;

    public $table = 'notification_types';

    
    public $translatable = ['name', 'default_text'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const USER_TYPE_SELECT = [
        'staff'    => 'أدمن',
        'customer' => 'عميل',
        'seller'   => 'بائع',
    ];

    protected $fillable = [
        'user_type',
        'type',
        'name',
        'default_text',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
