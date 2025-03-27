<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 20,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 21,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 25,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 26,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 30,
                'title' => 'product_category_create',
            ],
            [
                'id'    => 31,
                'title' => 'product_category_edit',
            ],
            [
                'id'    => 32,
                'title' => 'product_category_show',
            ],
            [
                'id'    => 33,
                'title' => 'product_category_delete',
            ],
            [
                'id'    => 34,
                'title' => 'product_category_access',
            ],
            [
                'id'    => 35,
                'title' => 'brand_create',
            ],
            [
                'id'    => 36,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 37,
                'title' => 'brand_show',
            ],
            [
                'id'    => 38,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 39,
                'title' => 'brand_access',
            ],
            [
                'id'    => 40,
                'title' => 'product_create',
            ],
            [
                'id'    => 41,
                'title' => 'product_edit',
            ],
            [
                'id'    => 42,
                'title' => 'product_show',
            ],
            [
                'id'    => 43,
                'title' => 'product_delete',
            ],
            [
                'id'    => 44,
                'title' => 'product_access',
            ],
            [
                'id'    => 45,
                'title' => 'product_favorite_create',
            ],
            [
                'id'    => 46,
                'title' => 'product_favorite_edit',
            ],
            [
                'id'    => 47,
                'title' => 'product_favorite_show',
            ],
            [
                'id'    => 48,
                'title' => 'product_favorite_delete',
            ],
            [
                'id'    => 49,
                'title' => 'product_favorite_access',
            ],
            [
                'id'    => 50,
                'title' => 'country_managment_access',
            ],
            [
                'id'    => 51,
                'title' => 'district_create',
            ],
            [
                'id'    => 52,
                'title' => 'district_edit',
            ],
            [
                'id'    => 53,
                'title' => 'district_show',
            ],
            [
                'id'    => 54,
                'title' => 'district_delete',
            ],
            [
                'id'    => 55,
                'title' => 'district_access',
            ],
            [
                'id'    => 56,
                'title' => 'city_create',
            ],
            [
                'id'    => 57,
                'title' => 'city_edit',
            ],
            [
                'id'    => 58,
                'title' => 'city_show',
            ],
            [
                'id'    => 59,
                'title' => 'city_delete',
            ],
            [
                'id'    => 60,
                'title' => 'city_access',
            ],
            [
                'id'    => 61,
                'title' => 'store_create',
            ],
            [
                'id'    => 62,
                'title' => 'store_edit',
            ],
            [
                'id'    => 63,
                'title' => 'store_show',
            ],
            [
                'id'    => 64,
                'title' => 'store_delete',
            ],
            [
                'id'    => 65,
                'title' => 'store_access',
            ],
            [
                'id'    => 66,
                'title' => 'cart_create',
            ],
            [
                'id'    => 67,
                'title' => 'cart_edit',
            ],
            [
                'id'    => 68,
                'title' => 'cart_show',
            ],
            [
                'id'    => 69,
                'title' => 'cart_delete',
            ],
            [
                'id'    => 70,
                'title' => 'cart_access',
            ],
            [
                'id'    => 71,
                'title' => 'combined_order_create',
            ],
            [
                'id'    => 72,
                'title' => 'combined_order_edit',
            ],
            [
                'id'    => 73,
                'title' => 'combined_order_show',
            ],
            [
                'id'    => 74,
                'title' => 'combined_order_delete',
            ],
            [
                'id'    => 75,
                'title' => 'combined_order_access',
            ],
            [
                'id'    => 76,
                'title' => 'order_create',
            ],
            [
                'id'    => 77,
                'title' => 'order_edit',
            ],
            [
                'id'    => 78,
                'title' => 'order_show',
            ],
            [
                'id'    => 79,
                'title' => 'order_delete',
            ],
            [
                'id'    => 80,
                'title' => 'order_access',
            ],
            [
                'id'    => 81,
                'title' => 'order_detail_create',
            ],
            [
                'id'    => 82,
                'title' => 'order_detail_edit',
            ],
            [
                'id'    => 83,
                'title' => 'order_detail_show',
            ],
            [
                'id'    => 84,
                'title' => 'order_detail_delete',
            ],
            [
                'id'    => 85,
                'title' => 'order_detail_access',
            ],
            [
                'id'    => 86,
                'title' => 'refund_request_create',
            ],
            [
                'id'    => 87,
                'title' => 'refund_request_edit',
            ],
            [
                'id'    => 88,
                'title' => 'refund_request_show',
            ],
            [
                'id'    => 89,
                'title' => 'refund_request_delete',
            ],
            [
                'id'    => 90,
                'title' => 'refund_request_access',
            ],
            [
                'id'    => 91,
                'title' => 'product_review_create',
            ],
            [
                'id'    => 92,
                'title' => 'product_review_edit',
            ],
            [
                'id'    => 93,
                'title' => 'product_review_show',
            ],
            [
                'id'    => 94,
                'title' => 'product_review_delete',
            ],
            [
                'id'    => 95,
                'title' => 'product_review_access',
            ],
            [
                'id'    => 96,
                'title' => 'store_review_create',
            ],
            [
                'id'    => 97,
                'title' => 'store_review_edit',
            ],
            [
                'id'    => 98,
                'title' => 'store_review_show',
            ],
            [
                'id'    => 99,
                'title' => 'store_review_delete',
            ],
            [
                'id'    => 100,
                'title' => 'store_review_access',
            ],
            [
                'id'    => 101,
                'title' => 'popup_create',
            ],
            [
                'id'    => 102,
                'title' => 'popup_edit',
            ],
            [
                'id'    => 103,
                'title' => 'popup_show',
            ],
            [
                'id'    => 104,
                'title' => 'popup_delete',
            ],
            [
                'id'    => 105,
                'title' => 'popup_access',
            ],
            [
                'id'    => 106,
                'title' => 'slider_create',
            ],
            [
                'id'    => 107,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 108,
                'title' => 'slider_show',
            ],
            [
                'id'    => 109,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 110,
                'title' => 'slider_access',
            ],
            [
                'id'    => 111,
                'title' => 'address_create',
            ],
            [
                'id'    => 112,
                'title' => 'address_edit',
            ],
            [
                'id'    => 113,
                'title' => 'address_show',
            ],
            [
                'id'    => 114,
                'title' => 'address_delete',
            ],
            [
                'id'    => 115,
                'title' => 'address_access',
            ],
            [
                'id'    => 116,
                'title' => 'customer_create',
            ],
            [
                'id'    => 117,
                'title' => 'customer_edit',
            ],
            [
                'id'    => 118,
                'title' => 'customer_show',
            ],
            [
                'id'    => 119,
                'title' => 'customer_delete',
            ],
            [
                'id'    => 120,
                'title' => 'customer_access',
            ],
            [
                'id'    => 121,
                'title' => 'attribute_create',
            ],
            [
                'id'    => 122,
                'title' => 'attribute_edit',
            ],
            [
                'id'    => 123,
                'title' => 'attribute_show',
            ],
            [
                'id'    => 124,
                'title' => 'attribute_delete',
            ],
            [
                'id'    => 125,
                'title' => 'attribute_access',
            ],
            [
                'id'    => 126,
                'title' => 'region_create',
            ],
            [
                'id'    => 127,
                'title' => 'region_edit',
            ],
            [
                'id'    => 128,
                'title' => 'region_show',
            ],
            [
                'id'    => 129,
                'title' => 'region_delete',
            ],
            [
                'id'    => 130,
                'title' => 'region_access',
            ],
            [
                'id'    => 131,
                'title' => 'store_follower_create',
            ],
            [
                'id'    => 132,
                'title' => 'store_follower_edit',
            ],
            [
                'id'    => 133,
                'title' => 'store_follower_show',
            ],
            [
                'id'    => 134,
                'title' => 'store_follower_delete',
            ],
            [
                'id'    => 135,
                'title' => 'store_follower_access',
            ],
            [
                'id'    => 136,
                'title' => 'store_complaint_create',
            ],
            [
                'id'    => 137,
                'title' => 'store_complaint_edit',
            ],
            [
                'id'    => 138,
                'title' => 'store_complaint_show',
            ],
            [
                'id'    => 139,
                'title' => 'store_complaint_delete',
            ],
            [
                'id'    => 140,
                'title' => 'store_complaint_access',
            ],
            [
                'id'    => 141,
                'title' => 'product_complaint_create',
            ],
            [
                'id'    => 142,
                'title' => 'product_complaint_edit',
            ],
            [
                'id'    => 143,
                'title' => 'product_complaint_show',
            ],
            [
                'id'    => 144,
                'title' => 'product_complaint_delete',
            ],
            [
                'id'    => 145,
                'title' => 'product_complaint_access',
            ],
            [
                'id'    => 146,
                'title' => 'product_stock_remember_create',
            ],
            [
                'id'    => 147,
                'title' => 'product_stock_remember_edit',
            ],
            [
                'id'    => 148,
                'title' => 'product_stock_remember_show',
            ],
            [
                'id'    => 149,
                'title' => 'product_stock_remember_delete',
            ],
            [
                'id'    => 150,
                'title' => 'product_stock_remember_access',
            ],
            [
                'id'    => 151,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 152,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 153,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 154,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 155,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 156,
                'title' => 'coupon_create',
            ],
            [
                'id'    => 157,
                'title' => 'coupon_edit',
            ],
            [
                'id'    => 158,
                'title' => 'coupon_show',
            ],
            [
                'id'    => 159,
                'title' => 'coupon_delete',
            ],
            [
                'id'    => 160,
                'title' => 'coupon_access',
            ],
            [
                'id'    => 161,
                'title' => 'coupon_usage_create',
            ],
            [
                'id'    => 162,
                'title' => 'coupon_usage_edit',
            ],
            [
                'id'    => 163,
                'title' => 'coupon_usage_show',
            ],
            [
                'id'    => 164,
                'title' => 'coupon_usage_delete',
            ],
            [
                'id'    => 165,
                'title' => 'coupon_usage_access',
            ],
            [
                'id'    => 166,
                'title' => 'color_create',
            ],
            [
                'id'    => 167,
                'title' => 'color_edit',
            ],
            [
                'id'    => 168,
                'title' => 'color_show',
            ],
            [
                'id'    => 169,
                'title' => 'color_delete',
            ],
            [
                'id'    => 170,
                'title' => 'color_access',
            ],
            [
                'id'    => 171,
                'title' => 'product_managment_access',
            ],
            [
                'id'    => 172,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 173,
                'title' => 'store_managment_access',
            ],
            [
                'id'    => 174,
                'title' => 'order_managment_access',
            ],
            [
                'id'    => 175,
                'title' => 'marketing_access',
            ],
            [
                'id'    => 176,
                'title' => 'special_order_create',
            ],
            [
                'id'    => 177,
                'title' => 'special_order_edit',
            ],
            [
                'id'    => 178,
                'title' => 'special_order_show',
            ],
            [
                'id'    => 179,
                'title' => 'special_order_delete',
            ],
            [
                'id'    => 180,
                'title' => 'special_order_access',
            ],
            [
                'id'    => 181,
                'title' => 'contactu_show',
            ],
            [
                'id'    => 182,
                'title' => 'contactu_delete',
            ],
            [
                'id'    => 183,
                'title' => 'contactu_access',
            ],
            [
                'id'    => 184,
                'title' => 'wallet_transaction_create',
            ],
            [
                'id'    => 185,
                'title' => 'wallet_transaction_edit',
            ],
            [
                'id'    => 186,
                'title' => 'wallet_transaction_show',
            ],
            [
                'id'    => 187,
                'title' => 'wallet_transaction_delete',
            ],
            [
                'id'    => 188,
                'title' => 'wallet_transaction_access',
            ],
            [
                'id'    => 189,
                'title' => 'customer_managment_access',
            ],
            [
                'id'    => 190,
                'title' => 'customer_point_create',
            ],
            [
                'id'    => 191,
                'title' => 'customer_point_edit',
            ],
            [
                'id'    => 192,
                'title' => 'customer_point_show',
            ],
            [
                'id'    => 193,
                'title' => 'customer_point_delete',
            ],
            [
                'id'    => 194,
                'title' => 'customer_point_access',
            ],
            [
                'id'    => 195,
                'title' => 'attribute_value_create',
            ],
            [
                'id'    => 196,
                'title' => 'attribute_value_edit',
            ],
            [
                'id'    => 197,
                'title' => 'attribute_value_show',
            ],
            [
                'id'    => 198,
                'title' => 'attribute_value_delete',
            ],
            [
                'id'    => 199,
                'title' => 'attribute_value_access',
            ],
            [
                'id'    => 200,
                'title' => 'setting_create',
            ],
            [
                'id'    => 201,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 202,
                'title' => 'setting_show',
            ],
            [
                'id'    => 203,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 204,
                'title' => 'setting_access',
            ],
            [
                'id'    => 205,
                'title' => 'notification_managment_access',
            ],
            [
                'id'    => 206,
                'title' => 'notification_type_create',
            ],
            [
                'id'    => 207,
                'title' => 'notification_type_edit',
            ],
            [
                'id'    => 208,
                'title' => 'notification_type_show',
            ],
            [
                'id'    => 209,
                'title' => 'notification_type_delete',
            ],
            [
                'id'    => 210,
                'title' => 'notification_type_access',
            ],
            [
                'id'    => 211,
                'title' => 'notification_create',
            ],
            [
                'id'    => 212,
                'title' => 'notification_edit',
            ],
            [
                'id'    => 213,
                'title' => 'notification_show',
            ],
            [
                'id'    => 214,
                'title' => 'notification_delete',
            ],
            [
                'id'    => 215,
                'title' => 'notification_access',
            ],
            [
                'id'    => 216,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
