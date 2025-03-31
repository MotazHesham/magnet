<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scratch extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'scratches';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DISCOUNT_TYPE_SELECT = [
        'percentage' => 'نسبة',
        'amount'     => 'قيمة',
    ];

    protected $fillable = [
        'name',
        'code',
        'discount_type',
        'discount',
        'expiration_days',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
