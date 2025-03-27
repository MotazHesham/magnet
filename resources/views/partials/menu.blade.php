<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/brands*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/attributes*") ? "c-show" : "" }} {{ request()->is("admin/attribute-values*") ? "c-show" : "" }} {{ request()->is("admin/colors*") ? "c-show" : "" }} {{ request()->is("admin/product-reviews*") ? "c-show" : "" }} {{ request()->is("admin/product-complaints*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-parking c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('brand_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.brands.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/brands") || request()->is("admin/brands/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-code-branch c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.brand.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-product-hunt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('attribute_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.attributes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/attributes") || request()->is("admin/attributes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-asterisk c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.attribute.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('attribute_value_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.attribute-values.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/attribute-values") || request()->is("admin/attribute-values/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.attributeValue.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('color_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.colors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/colors") || request()->is("admin/colors/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-palette c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.color.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_review_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-reviews.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-reviews") || request()->is("admin/product-reviews/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-star c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productReview.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_complaint_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-complaints.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-complaints") || request()->is("admin/product-complaints/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exclamation c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productComplaint.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('customer_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/customers*") ? "c-show" : "" }} {{ request()->is("admin/wallet-transactions*") ? "c-show" : "" }} {{ request()->is("admin/customer-points*") ? "c-show" : "" }} {{ request()->is("admin/addresses*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.customerManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('customer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.customers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customers") || request()->is("admin/customers/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.customer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('wallet_transaction_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.wallet-transactions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/wallet-transactions") || request()->is("admin/wallet-transactions/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.walletTransaction.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('customer_point_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.customer-points.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/customer-points") || request()->is("admin/customer-points/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-medal c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.customerPoint.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('address_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.addresses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/addresses") || request()->is("admin/addresses/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.address.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('store_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/stores*") ? "c-show" : "" }} {{ request()->is("admin/store-reviews*") ? "c-show" : "" }} {{ request()->is("admin/store-followers*") ? "c-show" : "" }} {{ request()->is("admin/store-complaints*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-store-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.storeManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('store_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.stores.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/stores") || request()->is("admin/stores/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-store-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.store.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('store_review_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.store-reviews.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/store-reviews") || request()->is("admin/store-reviews/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-star-half-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.storeReview.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('store_follower_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.store-followers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/store-followers") || request()->is("admin/store-followers/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.storeFollower.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('store_complaint_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.store-complaints.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/store-complaints") || request()->is("admin/store-complaints/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exclamation c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.storeComplaint.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('order_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/combined-orders*") ? "c-show" : "" }} {{ request()->is("admin/orders*") ? "c-show" : "" }} {{ request()->is("admin/order-details*") ? "c-show" : "" }} {{ request()->is("admin/refund-requests*") ? "c-show" : "" }} {{ request()->is("admin/special-orders*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.orderManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('combined_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.combined-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/combined-orders") || request()->is("admin/combined-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-boxes c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.combinedOrder.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.order.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.order-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-details") || request()->is("admin/order-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('refund_request_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.refund-requests.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/refund-requests") || request()->is("admin/refund-requests/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.refundRequest.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('special_order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.special-orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/special-orders") || request()->is("admin/special-orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-box c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.specialOrder.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('marketing_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-favorites*") ? "c-show" : "" }} {{ request()->is("admin/coupons*") ? "c-show" : "" }} {{ request()->is("admin/coupon-usages*") ? "c-show" : "" }} {{ request()->is("admin/carts*") ? "c-show" : "" }} {{ request()->is("admin/product-stock-remembers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bullhorn c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.marketing.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('product_favorite_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-favorites.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-favorites") || request()->is("admin/product-favorites/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-heart c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productFavorite.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('coupon_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coupons.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coupons") || request()->is("admin/coupons/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-award c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.coupon.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('coupon_usage_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.coupon-usages.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/coupon-usages") || request()->is("admin/coupon-usages/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.couponUsage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cart_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.carts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/carts") || request()->is("admin/carts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cart-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.cart.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_stock_remember_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-stock-remembers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-stock-remembers") || request()->is("admin/product-stock-remembers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productStockRemember.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('country_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/regions*") ? "c-show" : "" }} {{ request()->is("admin/cities*") ? "c-show" : "" }} {{ request()->is("admin/districts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-globe-americas c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.countryManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('region_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.regions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/regions") || request()->is("admin/regions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.region.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.cities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/cities") || request()->is("admin/cities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('district_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.districts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/districts") || request()->is("admin/districts/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.district.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('notification_managment_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/notifications*") ? "c-show" : "" }} {{ request()->is("admin/notification-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bullhorn c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.notificationManagment.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('notification_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.notifications.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/notifications") || request()->is("admin/notifications/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.notification.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('notification_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.notification-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/notification-types") || request()->is("admin/notification-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.notificationType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('faq_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/faq-categories*") ? "c-show" : "" }} {{ request()->is("admin/faq-questions*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.faqManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('faq_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('faq_question_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.faq-questions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-question c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.faqQuestion.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('general_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/popups*") ? "c-show" : "" }} {{ request()->is("admin/sliders*") ? "c-show" : "" }} {{ request()->is("admin/payment-methods*") ? "c-show" : "" }} {{ request()->is("admin/contactus*") ? "c-show" : "" }} {{ request()->is("admin/settings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.generalSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('popup_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.popups.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/popups") || request()->is("admin/popups/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-images c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.popup.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('slider_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.sliders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-image c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.slider.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_method_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentMethod.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('contactu_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.contactus.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/contactus") || request()->is("admin/contactus/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-address-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.contactu.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.setting.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>