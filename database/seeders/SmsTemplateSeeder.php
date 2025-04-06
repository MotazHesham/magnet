<?php

namespace Database\Seeders;

use App\Models\SmsTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmsTemplate::create([ 
            'identifier' => 'phone_number_verification',
            'name' => 'Phone Verification',
            'sms_body' => '[[code]] is your verification code for [[site_name]].', 
            'status' => 1,
        ]);
        SmsTemplate::create([ 
            'identifier' => 'password_reset',
            'name' => 'Password Reset',
            'sms_body' => 'Your password reset code is [[code]].', 
            'status' => 1,
        ]);
        SmsTemplate::create([ 
            'identifier' => 'order_placement',
            'name' => 'Order Placement',
            'sms_body' => 'Your order has been placed and Order Code is [[order_code]]', 
            'status' => 1,
        ]);
        SmsTemplate::create([ 
            'identifier' => 'delivery_status_change',
            'name' => 'Delivery Status Changed',
            'sms_body' => 'Your delivery status has been updated to [[delivery_status]]  for Order code : [[order_code]]', 
            'status' => 1,
        ]);
        SmsTemplate::create([ 
            'identifier' => 'payment_status_change',
            'name' => 'Payment Status Changed',
            'sms_body' => 'Your payment status has been updated to [[payment_status]] for Order code : [[order_code]]', 
            'status' => 1,
        ]);
        SmsTemplate::create([ 
            'identifier' => 'account_opening',
            'name' => 'Account Opening',
            'sms_body' => 'Hi! An account has been created on [[site_name]]. Your account type is: [[user_type]], password is: [[password]] and the verification code is [[code]] .', 
            'status' => 1,
        ]);
    }
}
