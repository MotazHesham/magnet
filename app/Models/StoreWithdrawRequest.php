<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoreWithdrawRequest extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'store_withdraw_requests';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'pending'  => 'pending',
        'paid'     => 'paid',
        'rejected' => 'rejected',
    ];

    protected $fillable = [
        'store_id',
        'amount',
        'note',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
