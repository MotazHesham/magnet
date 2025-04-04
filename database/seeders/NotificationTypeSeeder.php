<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        //pending
        NotificationType::create([ 
            'user_type' => 'staff', 'type' => 'order_placed_staff', 'status' => 1,
            'name' => [ 'en' => 'New Order Placed', 'ar' => 'طلب جديد' ],
            'default_text' => [ 'en' => 'New Order: [[order_code]] has been Placed', 'ar' => 'طلب جديد: [[order_code]] تم أضافته' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'seller', 'type' => 'order_placed_seller', 'status' => 1,
            'name' => [ 'en' => 'New Order Placed', 'ar' => 'طلب جديد' ],
            'default_text' => [ 'en' => 'New Order: [[order_code]] has been Placed', 'ar' => 'طلب جديد: [[order_code]] تم أضافته' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_placed_customer', 'status' => 1,
            'name' => [ 'en' => 'Order Placed', 'ar' => 'تم أضافة الطلب' ],
            'default_text' => [ 'en' => 'Your Order: [[order_code]] has been Placed', 'ar' => 'طلبك: [[order_code]] تم أضافته' ],
        ]);

        //store_approved
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_store_approved_customer', 'status' => 1,
            'name' => [ 'en' => 'Order Approved', 'ar' => 'تم الموافقة علي الطلب' ],
            'default_text' => [ 'en' => 'Your Order: [[order_code]] has been Approved', 'ar' => 'طلبك: [[order_code]] تم الموافقة عليه' ],
        ]);

        //store_rejected
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_store_rejected_customer', 'status' => 1,
            'name' => [ 'en' => 'Order Rejected', 'ar' => 'تم إلغاء الطلب' ],
            'default_text' => [ 'en' => 'Your Order: [[order_code]] has been Rejected', 'ar' => 'طلبك: [[order_code]] تم إلغائه' ],
        ]);

        //preparing
        NotificationType::create([ 
            'user_type' => 'staff', 'type' => 'order_preparing_staff', 'status' => 1,
            'name' => [ 'en' => 'Order Paid', 'ar' => 'تم دفع الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Paid', 'ar' => 'الطلب: [[order_code]] تم دفعه' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'seller', 'type' => 'order_preparing_seller', 'status' => 1,
            'name' => [ 'en' => 'Order Paid', 'ar' => 'تم دفع الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Paid', 'ar' => 'الطلب: [[order_code]] تم دفعه' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_preparing_seller', 'status' => 1,
            'name' => [ 'en' => 'Order Paid', 'ar' => 'تم دفع الطلب' ],
            'default_text' => [ 'en' => 'Your payment for order: [[order_code]] is successfuly', 'ar' => 'دفعتك للطلب: [[order_code]] تمت بنجاح' ],
        ]);
        
        //prepared
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_prepared_customer', 'status' => 1,
            'name' => [ 'en' => 'Order Prepared', 'ar' => 'تم تجهيز الطلب' ],
            'default_text' => [ 'en' => 'Your Order: [[order_code]] has been Prepared', 'ar' => 'طلبك: [[order_code]] تم تجهيزه' ],
        ]);

        //on_delivery
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_on_delivery_customer', 'status' => 1,
            'name' => [ 'en' => 'Order On Delivery', 'ar' => 'تم إرسال الطلب للشحن' ],
            'default_text' => [ 'en' => 'Your Order: [[order_code]] has been sent to delivery', 'ar' => 'طلبك: [[order_code]] تم إرساله للشحن' ],
        ]);
        
        //delivered_from_store
        NotificationType::create([ 
            'user_type' => 'staff', 'type' => 'order_delivered_from_store_staff', 'status' => 1,
            'name' => [ 'en' => 'Order Delivered', 'ar' => 'تم شحن الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Delivered From Store', 'ar' => 'الطلب: [[order_code]] تم توصيل الطلب من المتجر' ],
        ]); 
        NotificationType::create([ 
            'user_type' => 'customer', 'type' => 'order_delivered_from_store_customer', 'status' => 1,
            'name' => [ 'en' => 'Order Delivered', 'ar' => 'تم شحن الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Delivered From Store', 'ar' => 'الطلب: [[order_code]] تم توصيل الطلب من المتجر' ],
        ]);
        
        //canceled_from_client
        NotificationType::create([ 
            'user_type' => 'staff', 'type' => 'order_canceled_from_client_staff', 'status' => 1,
            'name' => [ 'en' => 'Order Canceled', 'ar' => 'تم إلغاء الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Canceled From Client', 'ar' => 'الطلب: [[order_code]] تم إلغائه من العميل' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'seller', 'type' => 'order_canceled_from_client_seller', 'status' => 1,
            'name' => [ 'en' => 'Order Canceled', 'ar' => 'تم إلغاء الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Canceled From Client', 'ar' => 'الطلب: [[order_code]] تم إلغائه من العميل' ],
        ]); 
        
        //client_received
        NotificationType::create([ 
            'user_type' => 'staff', 'type' => 'order_client_received_staff', 'status' => 1,
            'name' => [ 'en' => 'Order Received', 'ar' => 'تم استلام الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Received From Client', 'ar' => 'الطلب: [[order_code]] تم استلام من العميل' ],
        ]);
        NotificationType::create([ 
            'user_type' => 'seller', 'type' => 'order_client_received_seller', 'status' => 1,
            'name' => [ 'en' => 'Order Received', 'ar' => 'تم استلام الطلب' ],
            'default_text' => [ 'en' => 'Order: [[order_code]] has been Received From Client', 'ar' => 'الطلب: [[order_code]] تم استلام من العميل' ],
        ]); 
    }
}
