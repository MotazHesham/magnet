<?php

namespace App\Models;

use App\Traits\Auditable;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletTransaction extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'wallet_transactions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const PAYMENT_METHOD_SELECT = [
        'online_payment' => 'Online Payment',
    ];

    public const TYPE_SELECT = [
        'charge' => 'إعادة شحن المحفظة',
        'order'  => 'دفع طلب',
    ];

    public const PAYMENT_STATUS_SELECT = [
        'un_paid' => 'لم يتم الدفع',
        'paid'    => 'تم الدفع',
    ];

    protected $fillable = [
        'type',
        'amount',
        'payment_status',
        'payment_data',
        'payment_method',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
