<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /**
         * Order Status
         */
        
        //pending
        EmailTemplate::create([  
            'user_type' => 'staff', 'identifier' => 'order_placed_email_staff', 'status' => 1,
            'subject' => 'Order Placed - [[order_code]]', 'email_type' => 'Order Placed',
            'default_text' => '',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'order_placed_email_seller', 'status' => 1,
            'subject' => 'New Order Placed - [[order_code]]', 'email_type' => 'New Order Placed',
            'default_text' => '',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_placed_email_customer', 'status' => 1,
            'subject' => 'New Order Placed - [[order_code]]', 'email_type' => 'New Order Placed',
            'default_text' => '',
        ]);

        //store_approved
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_store_approved_email_customer', 'status' => 1,
            'subject' => 'Order Approved - [[order_code]]', 'email_type' => 'Order Approved',
            'default_text' => '<p>&nbsp;</p><p><strong>Dear [[customer_name]],</strong></p><p>Thank you for your order! We’re excited to let you know that your order #[[order_code]] has been confirmed.</p><p><strong>Order Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>You will receive another email when your order is picked up.&nbsp;</p><p>If you have any questions or need further assistance, please don’t hesitate to contact us at [[admin_email]].</p><p>Best regards,</p><p>The [[store_name]] Team</p><p>&nbsp;</p>',
        ]);

        //store_rejected
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_store_rejected_email_customer', 'status' => 1,
            'subject' => 'Order Rejected - [[order_code]]', 'email_type' => 'Order Rejected',
            'default_text' => '',
        ]);

        //preparing
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'order_preparing_email_staff', 'status' => 1,
            'subject' => 'Order Paid - [[order_code]]', 'email_type' => 'Order Paid',
            'default_text' => '<p><strong>Dear [[admin_name]],</strong></p><p>Payment has been received for an order on [[store_name]]. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Payment Amount:</strong> [[order_amount]]</li></ul><p>Please proceed with processing the order and ensure it is moved forward in the fulfillment pipeline.</p><p>Best regards,</p><p>[[store_name]]</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'order_preparing_email_seller', 'status' => 1,
            'subject' => 'Order Paid - [[order_code]]', 'email_type' => 'Order Paid',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>A order has been paid from customer. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>Best regards,</p><p>[[store_name]]<br>&nbsp;</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_preparing_email_seller', 'status' => 1,
            'subject' => 'Order Paid - [[order_code]]', 'email_type' => 'Order Paid',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>We’re happy to inform you that we have received the payment for your order #[[order_code]]. Your order is now fully paid.</p><p><strong>Order Details:</strong></p><ul><li><strong>Order ID:</strong> [[order_code]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Payment Amount:</strong> [[order_amount]]</li></ul><p>Thank you for completing the payment. Your order will be processed shortly, and you will receive updates on its status.</p><p>If you have any questions or need assistance, feel free to contact us at [[admin_email]].</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        
        //prepared
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_prepared_email_customer', 'status' => 1,
            'subject' => 'Order Prepared - [[order_code]]', 'email_type' => 'Order Prepared',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>Thank you for your order! We’re excited to let you know that your order #[[order_code]] has been Prepared.</p><p><strong>Order Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>You will receive another email when your order is on the way.&nbsp;</p><p>If you have any questions or need further assistance, please don’t hesitate to contact us at [[admin_email]].</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);

        //on_delivery
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_on_delivery_email_customer', 'status' => 1,
            'subject' => 'Order On Delivery - [[order_code]]', 'email_type' => 'Order On Delivery',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>Thank you for your order! We’re excited to let you know that your order #[[order_code]] is on the way.</p><p><strong>Order Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>You will receive another email when your order is delivered.&nbsp;</p><p>If you have any questions or need further assistance, please don’t hesitate to contact us at [[admin_email]].</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        
        //delivered_from_store
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'order_delivered_from_store_email_staff', 'status' => 1,
            'subject' => 'Order Delivered - [[order_code]]', 'email_type' => 'Order Delivered',
            'default_text' => '<p><strong>Dear [[admin_name]],</strong></p><p>An order has been marked as delivered on [[store_name]]. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Delivery Date:</strong> [[delivery_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]&nbsp;</li></ul><p>Best regards,</p><p>[[store_name]]</p>',
        ]); 
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'order_delivered_from_store_email_customer', 'status' => 1,
            'subject' => 'Order Delivered - [[order_code]]', 'email_type' => 'Order Delivered',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>We’re pleased to inform you that your order #[[order_code]] has been successfully delivered!</p><p><strong>Order Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Delivery Date:</strong> [[delivery_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>We hope you are satisfied with your purchase. If you have any questions or need further assistance, please don’t hesitate to reach out at [[admin_email]].</p><p>Thank you for shopping with us!</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        
        //canceled_from_client
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'order_canceled_from_client_email_staff', 'status' => 1,
            'subject' => 'Order Canceled - [[order_code]]', 'email_type' => 'Order Canceled',
            'default_text' => '<p><strong>Dear [[admin_name]],</strong></p><p>An order has been cancelled on [[store_name]]. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>Please review the cancellation details and update the order status accordingly.</p><p>Best regards,</p><p>[[store_name]]</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'order_canceled_from_client_email_seller', 'status' => 1,
            'subject' => 'Order Canceled - [[order_code]]', 'email_type' => 'Order Canceled',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>An order has been cancelled from customer. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]</li></ul><p>Please review the cancellation details and update the order status accordingly.</p><p>Best regards,</p><p>[[store_name]]</p>',
        ]); 
        
        //client_received
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'order_client_received_email_staff', 'status' => 1,
            'subject' => 'Order Received - [[order_code]]', 'email_type' => 'Order Received',
            'default_text' => '<p><strong>Dear [[admin_name]],</strong></p><p>An order has been Received From Customer on [[store_name]]. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]&nbsp;</li></ul><p>Best regards,</p><p>[[store_name]]</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'order_client_received_email_seller', 'status' => 1,
            'subject' => 'Order Received - [[order_code]]', 'email_type' => 'Order Received',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>An order has been received from customer. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Order Date:</strong> [[order_date]]</li><li><strong>Total Amount:</strong> [[order_amount]]&nbsp;</li></ul><p>Best regards,</p><p>[[store_name]]</p>',
        ]); 

        
        /**
         * Refund Requests
         */

        // customer
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'refund_request_email_customer', 'status' => 1,
            'subject' => 'Refund Request Received for Order [[order_code]]', 'email_type' => 'Refund Request',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>We have received your refund request for order [[order_code]].</p><p><strong>Refund Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Reason:</strong> [[refund_reason]]</li></ul><p>Our team is currently reviewing your request and will get back to you with an update as soon as possible. If you have any questions or need further information, please contact us at [[admin_email]].</p><p>Thank you for your patience.</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'refund_request_approved_email_customer', 'status' => 1,
            'subject' => 'Refund Accepted for Order [[order_code]]', 'email_type' => 'Refund Request Accepted',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>We’re pleased to inform you that your refund request for order [[order_code]] has been accepted.</p><p><strong>Refund Details:</strong></p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Amount:</strong> [[refund_amount]]</li><li><strong>Processed Date:</strong> [[processes_date]]</li></ul><p>If you have any questions or need further assistance, please contact us at [[admin_email]]. Thank you for your patience and understanding.</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'customer', 'identifier' => 'refund_request_rejected_email_customer', 'status' => 1,
            'subject' => 'Refund Request Denied for Order [[order_code]]', 'email_type' => 'Refund Request Denied',
            'default_text' => '<p><strong>Dear [[customer_name]],</strong></p><p>We regret to inform you that your refund request for order #[Order ID] has been denied.</p><ul><li><strong>Refund Details:</strong></li><li><strong>Order ID:</strong> [[order_code]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Amount:</strong> [[refund_amount]]</li></ul><p>If you have any questions or need further clarification, please contact us at [[admin_email]].</p><p>We appreciate your understanding and apologize for any inconvenience this may cause.</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);

        //seller
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'refund_request_email_seller', 'status' => 1,
            'subject' => 'New Refund Request for Order [[order_code]]', 'email_type' => 'Refund Request',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>A refund request has been submitted by [[customer_name]] for an order [[order_code]] containing your product. Please review the following details:&nbsp;</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Product Sold:</strong> [[product_name]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Reason:</strong> [[refund_reason]]</li></ul><p>Kindly review the request and process it as per our refund policy. If you need any assistance or additional information, feel free to reach out at [[admin_email]].</p><p>Best regards,</p><p>The [[store_name]] team</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'refund_request_accepted_by_admin_email_seller', 'status' => 1,
            'subject' => 'Refund Request Accepted for Order [[order_code]]', 'email_type' => 'Refund Request Accepted by Admin',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>The refund request from [[customer_name]] for order #[[order_code]] has been reviewed and accepted. Below are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Amount:</strong> [[refund_amount]]</li><li><strong>Processed Date:</strong> [[processes_date]]</li></ul><p>Please take the necessary steps to update your records and ensure that the refund is processed according to our policy. Feel free to reach out if you have any questions or need further assistance.</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'refund_request_denied_by_admin_email_seller', 'status' => 1,
            'subject' => 'Refund Request Denied for Order [[order_code]]', 'email_type' => 'Refund Request Denied by Admin',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>The refund request for order [[order_code]] has been denied. Here are the details:</p><ul><li><strong>Order Code:</strong> [[order_code]]</li><li><strong>Customer Name:</strong> [[customer_name]]</li><li><strong>Request Date:</strong> [[request_date]]</li><li><strong>Refund Amount:</strong> [[refund_amount]]</li><li><strong>Refund denied Reason</strong>: [[denied_reason]]</li></ul><p>Please update the order status to reflect the denied refund and ensure that the customer is notified.</p><p>Best regards,</p><p>&nbsp;</p><p>The [[store_name]] Team</p>',
        ]); 

        //staff
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'refund_request_email_staff', 'status' => 1,
            'subject' => 'New Refund Request for Order [[order_code]]', 'email_type' => 'Refund Request',
            'default_text' => '',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'refund_request_accepted_by_seller_email_staff', 'status' => 1,
            'subject' => 'Refund Request for Order [[order_code]] has been accepted by [[shop_name]]', 'email_type' => 'Refund Request Accepted by Seller',
            'default_text' => '',
        ]);
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'refund_request_denied_by_seller_email_staff', 'status' => 1,
            'subject' => 'Refund Request Denied by seller [[shop_name]] for Order [[order_code]]', 'email_type' => 'Refund Request Denied by Seller',
            'default_text' => '',
        ]);

        
        /**
         * Registeration
         */
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'registration_from_system_email_seller', 'status' => 1,
            'subject' => 'Welcome to - [[store_name]]', 'email_type' => 'Seller Registration By Admin',
            'default_text' => '<p><strong>Dear [[seller_name]],</strong></p><p>Congratulations! An account has been created on the [[store_name]] ! We’re thrilled to have you on board and look forward to seeing your products in our marketplace.</p><p>Here are your account details:</p><ul><li><strong>Name:</strong> [[seller_name]]</li><li><strong>Email:</strong> [[seller_email]]</li><li><strong>Password:</strong> [[password]]</li><li><strong>Shop Name: </strong>[[seller_shop_name]]</li><li><strong>Address: </strong>[[seller_shop_address]]</li><li><strong>Registration Date:</strong> [[date]]</li></ul><p>To manage your store and list your products, please log in to your seller account <a href="http://local.magnet/">here</a> . If you need any assistance, our seller support team is available to help you with any questions or issues. Contact us at [[admin_email]].</p><p>Thank you for choosing to partner with us!</p><p>Best regards,</p><p>The [[store_name]] Team</p>',
        ]);  
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'customer_reg_email_staff', 'status' => 1,
            'subject' => 'New Customer Registration - [[customer_name]]', 'email_type' => 'Customer Registration',
            'default_text' => '',
        ]);  
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'seller_reg_email_staff', 'status' => 1,
            'subject' => 'New Seller Registration - [[shop_name]]', 'email_type' => 'Seller Registration',
            'default_text' => '',
        ]);  

        /**
         * WithDrawRequests
         */ 
        EmailTemplate::create([ 
            'user_type' => 'seller', 'identifier' => 'withdraw_request_email_seller', 'status' => 1,
            'subject' => 'Payment Confirmation from [[store_name]]', 'email_type' => 'Payout Received',
            'default_text' => '<p><strong>Dear [[shop_name]],</strong></p><p>We are pleased to inform you that your payment has been successfully processed. Below are the details of the transaction:</p><p><strong>Payment Details:</strong></p><ul><li><strong>Payment Date:</strong> [[date]]</li><li><strong>Amount Paid:</strong> [[amount]]</li><li><strong>Payment Method:</strong> [[payment_method]]</li></ul><p>Should you have any questions or concerns, feel free to reach out to us at [[admin_email]].</p><p>Thank you for being a valued partner with us.</p><p>Best regards,<br>The [[store_name]] team</p>',
        ]);  
        EmailTemplate::create([ 
            'user_type' => 'staff', 'identifier' => 'withdraw_request_email_staff', 'status' => 1,
            'subject' => 'Seller Payout Request [[shop_name]]', 'email_type' => 'Seller Payout Request',
            'default_text' => '',
        ]);  

    }
}
