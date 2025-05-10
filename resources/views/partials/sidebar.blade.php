<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="#" class="header-logo">
            <h5>
                {{ trans('panel.site_title') }}
            </h5>
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">
                <!-- Dashboard -->
                <li class="slide">
                    <a href="{{ route("admin.home") }}" class="side-menu__item {{ request()->is("admin") ? "active" : "" }}">
                        <i class="fa-regular fa-gauge"></i>
                        <span class="side-menu__label">{{ trans('global.dashboard') }}</span>
                    </a>
                </li>

                <!-- Products & Inventory -->
                @can('product_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-box"></i>
                        <span class="side-menu__label">{{ trans('cruds.productManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('product_category_access')
                        <li><a href="{{ route("admin.product-categories.index") }}" class="side-menu__item {{ request()->is("admin/product-categories*") ? "active" : "" }}">
                            <i class="fa-regular fa-folder"></i> {{ trans('cruds.productCategory.title') }}</a></li>
                        @endcan
                        @can('brand_access')
                        <li><a href="{{ route("admin.brands.index") }}" class="side-menu__item {{ request()->is("admin/brands*") ? "active" : "" }}">
                            <i class="fa-regular fa-code-branch"></i> {{ trans('cruds.brand.title') }}</a></li>
                        @endcan
                        @can('product_access')
                        <li><a href="{{ route("admin.products.index") }}" class="side-menu__item {{ request()->is("admin/products*") ? "active" : "" }}">
                            <i class="fa-regular fa-box"></i> {{ trans('cruds.product.title') }}</a></li>
                        @endcan
                        @can('attribute_access')
                        <li><a href="{{ route("admin.attributes.index") }}" class="side-menu__item {{ request()->is("admin/attributes*") ? "active" : "" }}">
                            <i class="fa-regular fa-asterisk"></i> {{ trans('cruds.attribute.title') }}</a></li>
                        @endcan
                        @can('color_access')
                        <li><a href="{{ route("admin.colors.index") }}" class="side-menu__item {{ request()->is("admin/colors*") ? "active" : "" }}">
                            <i class="fa-regular fa-palette"></i> {{ trans('cruds.color.title') }}</a></li>
                        @endcan
                        @can('product_review_access')
                        <li><a href="{{ route("admin.product-reviews.index") }}" class="side-menu__item {{ request()->is("admin/product-reviews*") ? "active" : "" }}">
                            <i class="fa-regular fa-star"></i> {{ trans('cruds.productReview.title') }}</a></li>
                        @endcan
                        @can('product_complaint_access')
                        <li><a href="{{ route("admin.product-complaints.index") }}" class="side-menu__item {{ request()->is("admin/product-complaints*") ? "active" : "" }}">
                            <i class="fa-regular fa-circle-exclamation"></i> {{ trans('cruds.productComplaint.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Orders & Sales -->
                @can('order_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-shopping-cart"></i>
                        <span class="side-menu__label">{{ trans('cruds.orderManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('order_access')
                        <li><a href="{{ route("admin.orders.index") }}" class="side-menu__item {{ request()->is("admin/orders*") ? "active" : "" }}">
                            <i class="fa-regular fa-box-open"></i> {{ trans('cruds.order.title') }}</a></li>
                        @endcan
                        @can('special_order_access')
                        <li><a href="{{ route("admin.special-orders.index") }}" class="side-menu__item {{ request()->is("admin/special-orders*") ? "active" : "" }}">
                            <i class="fa-regular fa-box"></i> {{ trans('cruds.specialOrder.title') }}</a></li>
                        @endcan
                        @can('refund_request_access')
                        <li><a href="{{ route("admin.refund-requests.index") }}" class="side-menu__item {{ request()->is("admin/refund-requests*") ? "active" : "" }}">
                            <i class="fa-regular fa-exchange-alt"></i> {{ trans('cruds.refundRequest.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Customers & Marketing -->
                @can('customer_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-users"></i>
                        <span class="side-menu__label">{{ trans('cruds.customerManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('customer_access')
                        <li><a href="{{ route("admin.customers.index") }}" class="side-menu__item {{ request()->is("admin/customers*") ? "active" : "" }}">
                            <i class="fa-regular fa-user"></i> {{ trans('cruds.customer.title') }}</a></li>
                        @endcan
                        @can('wallet_transaction_access')
                        <li><a href="{{ route("admin.wallet-transactions.index") }}" class="side-menu__item {{ request()->is("admin/wallet-transactions*") ? "active" : "" }}">
                            <i class="fa-regular fa-credit-card"></i> {{ trans('cruds.walletTransaction.title') }}</a></li>
                        @endcan
                        @can('customer_point_access')
                        <li><a href="{{ route("admin.customer-points.index") }}" class="side-menu__item {{ request()->is("admin/customer-points*") ? "active" : "" }}">
                            <i class="fa-regular fa-medal"></i> {{ trans('cruds.customerPoint.title') }}</a></li>
                        @endcan
                        @can('address_access')
                        <li><a href="{{ route("admin.addresses.index") }}" class="side-menu__item {{ request()->is("admin/addresses*") ? "active" : "" }}">
                            <i class="fa-regular fa-address-card"></i> {{ trans('cruds.address.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Store Management -->
                @can('store_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-store"></i>
                        <span class="side-menu__label">{{ trans('cruds.storeManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('store_access')
                        <li><a href="{{ route("admin.stores.index") }}" class="side-menu__item {{ request()->is("admin/stores*") ? "active" : "" }}">
                            <i class="fa-regular fa-store-alt"></i> {{ trans('cruds.store.title') }}</a></li>
                        @endcan
                        @can('store_city_access')
                        <li><a href="{{ route("admin.store-cities.index") }}" class="side-menu__item {{ request()->is("admin/store-cities*") ? "active" : "" }}">
                            <i class="fa-regular fa-globe-americas"></i> {{ trans('cruds.storeCity.title') }}</a></li>
                        @endcan
                        @can('store_withdraw_request_access')
                        <li><a href="{{ route("admin.store-withdraw-requests.index") }}" class="side-menu__item {{ request()->is("admin/store-withdraw-requests*") ? "active" : "" }}">
                            <i class="fa-regular fa-wallet"></i> {{ trans('cruds.storeWithdrawRequest.title') }}</a></li>
                        @endcan
                        @can('commission_history_access')
                        <li><a href="{{ route("admin.commission-histories.index") }}" class="side-menu__item {{ request()->is("admin/commission-histories*") ? "active" : "" }}">
                            <i class="fa-regular fa-history"></i> {{ trans('cruds.commissionHistory.title') }}</a></li>
                        @endcan
                        @can('store_follower_access')
                        <li><a href="{{ route("admin.store-followers.index") }}" class="side-menu__item {{ request()->is("admin/store-followers*") ? "active" : "" }}">
                            <i class="fa-regular fa-bell"></i> {{ trans('cruds.storeFollower.title') }}</a></li>
                        @endcan
                        @can('store_complaint_access')
                        <li><a href="{{ route("admin.store-complaints.index") }}" class="side-menu__item {{ request()->is("admin/store-complaints*") ? "active" : "" }}">
                            <i class="fa-regular fa-circle-exclamation"></i> {{ trans('cruds.storeComplaint.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Marketing Tools -->
                @can('marketing_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-bullhorn"></i>
                        <span class="side-menu__label">{{ trans('cruds.marketing.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1"> 
                        @can('slider_access')
                        <li><a href="{{ route("admin.sliders.index") }}" class="side-menu__item {{ request()->is("admin/sliders*") ? "active" : "" }}">
                            <i class="fa-regular fa-image"></i> {{ trans('cruds.slider.title') }}</a></li>
                        @endcan
                        @can('popup_access')
                        <li><a href="{{ route("admin.popups.index") }}" class="side-menu__item {{ request()->is("admin/popups*") ? "active" : "" }}">
                            <i class="fa-regular fa-images"></i> {{ trans('cruds.popup.title') }}</a></li>
                        @endcan
                        @can('product_stock_remember_access')
                        <li><a href="{{ route("admin.product-stock-remembers.index") }}" class="side-menu__item {{ request()->is("admin/product-stock-remembers") || request()->is("admin/product-stock-remembers/*") ? "active" : "" }}">
                            <i class="fa-regular fa-bell"></i>{{ trans('cruds.productStockRemember.title') }}</a></li>
                        @endcan
                        @can('coupon_managment_access')
                            <li class="slide has-sub">
                                <a href="javascript:void(0);" class="side-menu__item">
                                    <i class="fa-regular fa-award"></i>
                                    <span class="side-menu__label">{{ trans('cruds.couponManagment.title') }}</span>
                                    <i class="ri-arrow-right-s-line side-menu__angle"></i>
                                </a>
                                <ul class="slide-menu child2">
                                    @can('coupon_access')
                                    <li><a href="{{ route("admin.coupons.index") }}" class="side-menu__item {{ request()->is("admin/coupons*") ? "active" : "" }}">
                                        <i class="fa-regular fa-award"></i> {{ trans('cruds.coupon.title') }}</a></li>
                                    @endcan
                                    @can('coupon_usage_access')
                                    <li><a href="{{ route("admin.coupon-usages.index") }}" class="side-menu__item {{ request()->is("admin/coupon-usages") || request()->is("admin/coupon-usages/*") ? "active" : "" }}">
                                        <i class="fa-regular fa-align-left"></i> {{ trans('cruds.couponUsage.title') }}</a></li>
                                    @endcan
                                    @can('scratch_access')
                                    <li><a href="{{ route("admin.scratches.index") }}" class="side-menu__item {{ request()->is("admin/scratches") || request()->is("admin/scratches/*") ? "active" : "" }}">
                                        <i class="fa-regular fa-barcode"></i> {{ trans('cruds.scratch.title') }}</a></li>
                                    @endcan
                                    @can('customer_scratch_access')
                                    <li><a href="{{ route("admin.customer-scratches.index") }}" class="side-menu__item {{ request()->is("admin/customer-scratches") || request()->is("admin/customer-scratches/*") ? "active" : "" }}">
                                        <i class="fa-regular fa-align-left"></i> {{ trans('cruds.customerScratch.title') }}</a></li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('cart_access')
                        <li><a href="{{ route("admin.carts.index") }}" class="side-menu__item {{ request()->is("admin/carts") || request()->is("admin/carts/*") ? "active" : "" }}">
                            <i class="fa-regular fa-cart-plus"></i>{{ trans('cruds.cart.title') }}</a></li>
                        @endcan
                        @can('product_favorite_access')
                        <li><a href="{{ route("admin.product-favorites.index") }}" class="side-menu__item {{ request()->is("admin/product-favorites") || request()->is("admin/product-favorites/*") ? "active" : "" }}">
                            <i class="fa-regular fa-heart"></i> {{ trans('cruds.productFavorite.title') }}</a></li>
                        @endcan
                        @can('search_access')
                        <li><a href="{{ route("admin.searches.index") }}" class="side-menu__item {{ request()->is("admin/searches") || request()->is("admin/searches/*") ? "active" : "" }}">
                            <i class="fa-regular fa-search"></i> {{ trans('cruds.search.title') }}</a></li>
                        @endcan
                        @can('contactu_access')
                        <li> <a href="{{ route("admin.contactus.index") }}" class="side-menu__item {{ request()->is("admin/contactus") || request()->is("admin/contactus/*") ? "active" : "" }}">
                            <i class="fa-regular fa-address-card"> </i> {{ trans('cruds.contactu.title') }} </a> </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- notificationManagment -->
                @can('notification_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-bell"></i>
                        <span class="side-menu__label">{{ trans('cruds.notificationManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('notification_type_access')
                        <li><a href="{{ route("admin.notification-types.index") }}" class="side-menu__item {{ request()->is("admin/notification-types*") ? "active" : "" }}">
                            <i class="fa-regular fa-align-center"></i> {{ trans('cruds.notificationType.title') }}</a></li>
                        @endcan
                        @can('notification_custom_access')
                        <li><a href="{{ route("admin.notification-customs.index") }}" class="side-menu__item {{ request()->is("admin/notification-customs*") ? "active" : "" }}">
                            <i class="fa-regular fa-volume-up"></i> {{ trans('cruds.notificationCustom.title') }}</a></li>
                        @endcan
                        @can('email_template_access')
                        <li><a href="{{ route("admin.email-templates.index") }}" class="side-menu__item {{ request()->is("admin/email-templates*") ? "active" : "" }}">
                            <i class="fa-regular fa-envelope"></i> {{ trans('cruds.emailTemplate.title') }}</a></li>
                        @endcan
                        @can('sms_template_access')
                        <li><a href="{{ route("admin.sms-templates.index") }}" class="side-menu__item {{ request()->is("admin/sms-templates") || request()->is("admin/sms-templates/*") ? "active" : "" }}">
                            <i class="fa-regular fa-comment-alt"></i> {{ trans('cruds.smsTemplate.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Location Management -->
                @can('country_managment_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-globe"></i>
                        <span class="side-menu__label">{{ trans('cruds.countryManagment.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('region_access')
                        <li><a href="{{ route("admin.regions.index") }}" class="side-menu__item {{ request()->is("admin/regions*") ? "active" : "" }}">
                            <i class="fa-regular fa-map-marked-alt"></i> {{ trans('cruds.region.title') }}</a></li>
                        @endcan
                        @can('city_access')
                        <li><a href="{{ route("admin.cities.index") }}" class="side-menu__item {{ request()->is("admin/cities*") ? "active" : "" }}">
                            <i class="fa-regular fa-map-marker-alt"></i> {{ trans('cruds.city.title') }}</a></li>
                        @endcan
                        @can('district_access')
                        <li><a href="{{ route("admin.districts.index") }}" class="side-menu__item {{ request()->is("admin/districts*") ? "active" : "" }}">
                            <i class="fa-regular fa-flag"></i> {{ trans('cruds.district.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- UserManagment -->
                @can('user_management_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-cog"></i>
                        <span class="side-menu__label">{{ trans('cruds.userManagement.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('role_access')
                        <li><a href="{{ route("admin.roles.index") }}" class="side-menu__item {{ request()->is("admin/roles*") ? "active" : "" }}">
                            <i class="fa-regular fa-briefcase"></i> {{ trans('cruds.role.title') }}</a></li>
                        @endcan
                        @can('user_access')
                        <li><a href="{{ route("admin.users.index") }}" class="side-menu__item {{ request()->is("admin/users*") ? "active" : "" }}">
                            <i class="fa-regular fa-user"></i> {{ trans('cruds.user.title') }}</a></li>
                        @endcan 
                        @can('audit_log_access')
                        <li><a href="{{ route("admin.audit-logs.index") }}" class="side-menu__item {{ request()->is("admin/audit-logs*") ? "active" : "" }}">
                            <i class="fa-regular fa-file-alt"></i> {{ trans('cruds.auditLog.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                <!-- Help & Support -->
                @can('faq_management_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-question-circle"></i>
                        <span class="side-menu__label">{{ trans('cruds.faqManagement.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        @can('faq_category_access')
                        <li><a href="{{ route("admin.faq-categories.index") }}" class="side-menu__item {{ request()->is("admin/faq-categories*") ? "active" : "" }}">
                            <i class="fa-regular fa-briefcase"></i> {{ trans('cruds.faqCategory.title') }}</a></li>
                        @endcan
                        @can('faq_question_access')
                        <li><a href="{{ route("admin.faq-questions.index") }}" class="side-menu__item {{ request()->is("admin/faq-questions*") ? "active" : "" }}">
                            <i class="fa-regular fa-question"></i> {{ trans('cruds.faqQuestion.title') }}</a></li>
                        @endcan 
                    </ul>
                </li>
                @endcan

                <!-- Settings -->
                @can('general_setting_access')
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item">
                        <i class="fa-regular fa-cog"></i>
                        <span class="side-menu__label">{{ trans('cruds.generalSetting.title') }}</span>
                        <i class="ri-arrow-right-s-line side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1"> 
                        @can('payment_method_access')
                        <li><a href="{{ route("admin.payment-methods.index") }}" class="side-menu__item {{ request()->is("admin/payment-methods*") ? "active" : "" }}">
                            <i class="fa-regular fa-credit-card"></i> {{ trans('cruds.paymentMethod.title') }}</a></li>
                        @endcan 
                        @can('setting_access')
                        <li> <a href="{{ route("admin.settings.index") }}" class="side-menu__item {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "active" : "" }}">
                            <i class="fa-regular fa-cog"> </i> {{ trans('cruds.setting.title') }} </a> </li>
                        @endcan
                        @can('smtp_settings_edit')
                        <li><a href="{{ route("admin.smtp-settings") }}" class="side-menu__item {{ request()->is("admin/smtp-settings") ? "active" : "" }}">
                            <i class="fa-regular fa-wrench"></i> Smtp Settings</a></li>
                        @endcan
                        @can('otp_method_access')
                        <li><a href="{{ route("admin.otp-methods.index") }}" class="side-menu__item {{ request()->is("admin/otp-methods") || request()->is("admin/otp-methods/*") ? "active" : "" }}">
                            <i class="fa-regular fa-mobile-alt"></i> {{ trans('cruds.otpMethod.title') }}</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan 
                <!-- Logout -->
                <li class="slide">
                    <a href="#" class="side-menu__item" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fa-regular fa-sign-out-alt"></i>
                        <span class="side-menu__label">{{ trans('global.logout') }}</span>
                    </a>
                </li>
            </ul> 
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->

    </div>
    <!-- End::main-sidebar -->

</aside> <!-- End::main-sidebar -->
