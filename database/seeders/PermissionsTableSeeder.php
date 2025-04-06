<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $i = 1;
        $permissions = [
            [
                'id'    => $i++,
                'title' => 'user_management_access',
            ],
            [
                'id'    => $i++,
                'title' => 'role_create',
            ],
            [
                'id'    => $i++,
                'title' => 'role_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'role_show',
            ],
            [
                'id'    => $i++,
                'title' => 'role_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'role_access',
            ],
            [
                'id'    => $i++,
                'title' => 'user_create',
            ],
            [
                'id'    => $i++,
                'title' => 'user_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'user_show',
            ],
            [
                'id'    => $i++,
                'title' => 'user_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'user_access',
            ],
            [
                'id'    => $i++,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => $i++,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_category_create',
            ],
            [
                'id'    => $i++,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'product_category_show',
            ],
            [
                'id'    => $i++,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'product_category_access',
            ],
            [
                'id'    => $i++,
                'title' => 'brand_create',
            ],
            [
                'id'    => $i++,
                'title' => 'brand_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'brand_show',
            ],
            [
                'id'    => $i++,
                'title' => 'brand_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'brand_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_create',
            ],
            [
                'id'    => $i++,
                'title' => 'product_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'product_show',
            ],
            [
                'id'    => $i++,
                'title' => 'product_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'product_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_favorite_access',
            ],
            [
                'id'    => $i++,
                'title' => 'country_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'district_create',
            ],
            [
                'id'    => $i++,
                'title' => 'district_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'district_show',
            ],
            [
                'id'    => $i++,
                'title' => 'district_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'district_access',
            ],
            [
                'id'    => $i++,
                'title' => 'city_create',
            ],
            [
                'id'    => $i++,
                'title' => 'city_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'city_show',
            ],
            [
                'id'    => $i++,
                'title' => 'city_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'city_access',
            ],
            [
                'id'    => $i++,
                'title' => 'store_create',
            ],
            [
                'id'    => $i++,
                'title' => 'store_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'store_show',
            ],
            [
                'id'    => $i++,
                'title' => 'store_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'store_access',
            ], 
            [
                'id'    => $i++,
                'title' => 'cart_access',
            ],
            [
                'id'    => $i++,
                'title' => 'order_create',
            ],
            [
                'id'    => $i++,
                'title' => 'order_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'order_show',
            ],
            [
                'id'    => $i++,
                'title' => 'order_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'order_access',
            ],
            [
                'id'    => $i++,
                'title' => 'order_detail_create',
            ],
            [
                'id'    => $i++,
                'title' => 'order_detail_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'order_detail_show',
            ],
            [
                'id'    => $i++,
                'title' => 'order_detail_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'order_detail_access',
            ],
            [
                'id'    => $i++,
                'title' => 'refund_request_create',
            ],
            [
                'id'    => $i++,
                'title' => 'refund_request_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'refund_request_show',
            ],
            [
                'id'    => $i++,
                'title' => 'refund_request_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'refund_request_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_review_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'product_review_access',
            ],
            [
                'id'    => $i++,
                'title' => 'popup_create',
            ],
            [
                'id'    => $i++,
                'title' => 'popup_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'popup_show',
            ],
            [
                'id'    => $i++,
                'title' => 'popup_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'popup_access',
            ],
            [
                'id'    => $i++,
                'title' => 'slider_create',
            ],
            [
                'id'    => $i++,
                'title' => 'slider_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'slider_show',
            ],
            [
                'id'    => $i++,
                'title' => 'slider_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'slider_access',
            ],
            [
                'id'    => $i++,
                'title' => 'address_show',
            ],
            [
                'id'    => $i++,
                'title' => 'address_access',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_create',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_show',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_access',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_create',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_show',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_access',
            ],
            [
                'id'    => $i++,
                'title' => 'region_create',
            ],
            [
                'id'    => $i++,
                'title' => 'region_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'region_show',
            ],
            [
                'id'    => $i++,
                'title' => 'region_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'region_access',
            ],
            [
                'id'    => $i++,
                'title' => 'store_follower_access',
            ],
            [
                'id'    => $i++,
                'title' => 'store_complaint_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_complaint_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_stock_remember_access',
            ],
            [
                'id'    => $i++,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_create',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_show',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_access',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_usage_access',
            ],
            [
                'id'    => $i++,
                'title' => 'color_create',
            ],
            [
                'id'    => $i++,
                'title' => 'color_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'color_show',
            ],
            [
                'id'    => $i++,
                'title' => 'color_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'color_access',
            ],
            [
                'id'    => $i++,
                'title' => 'product_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => $i++,
                'title' => 'store_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'order_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'marketing_access',
            ],
            [
                'id'    => $i++,
                'title' => 'special_order_create',
            ],
            [
                'id'    => $i++,
                'title' => 'special_order_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'special_order_show',
            ],
            [
                'id'    => $i++,
                'title' => 'special_order_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'special_order_access',
            ],
            [
                'id'    => $i++,
                'title' => 'contactu_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'contactu_access',
            ], 
            [
                'id'    => $i++,
                'title' => 'wallet_transaction_show',
            ], 
            [
                'id'    => $i++,
                'title' => 'wallet_transaction_access',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_point_access',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_value_create',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_value_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_value_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'attribute_value_access',
            ],
            [
                'id'    => $i++,
                'title' => 'setting_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'setting_access',
            ],
            [
                'id'    => $i++,
                'title' => 'scratch_create',
            ],
            [
                'id'    => $i++,
                'title' => 'scratch_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'scratch_show',
            ],
            [
                'id'    => $i++,
                'title' => 'scratch_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'scratch_access',
            ],
            [
                'id'    => $i++,
                'title' => 'customer_scratch_access',
            ],
            [
                'id'    => $i++,
                'title' => 'coupon_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_custom_create',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_custom_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_custom_show',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_custom_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_custom_access',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_type_create',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_type_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_type_show',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_type_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_type_access',
            ],
            [
                'id'    => $i++,
                'title' => 'store_withdraw_request_create',
            ],
            [
                'id'    => $i++,
                'title' => 'store_withdraw_request_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'store_withdraw_request_show',
            ],
            [
                'id'    => $i++,
                'title' => 'store_withdraw_request_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'store_withdraw_request_access',
            ],
            [
                'id'    => $i++,
                'title' => 'commission_history_show',
            ],
            [
                'id'    => $i++,
                'title' => 'commission_history_access',
            ], 
            [
                'id'    => $i++,
                'title' => 'store_city_edit',
            ], 
            [
                'id'    => $i++,
                'title' => 'store_city_access',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_create',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_show',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_delete',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_access',
            ],
            [
                'id'    => $i++,
                'title' => 'email_template_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'notification_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'report_access',
            ],
            [
                'id'    => $i++,
                'title' => 'search_access',
            ],
            [
                'id'    => $i++,
                'title' => 'otp_managment_access',
            ],
            [
                'id'    => $i++,
                'title' => 'otp_method_access',
            ],
            [
                'id'    => $i++,
                'title' => 'sms_template_edit',
            ],
            [
                'id'    => $i++,
                'title' => 'sms_template_access',
            ],
            [
                'id'    => $i++,
                'title' => 'smtp_settings',
            ],
            [
                'id'    => $i++,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
