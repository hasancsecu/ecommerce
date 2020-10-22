<?php

Route::get('/', function () {
        return view('pages.index');
});
//auth & user
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');
Route::get('/edit/profile/{id}', 'HomeController@editProfile');
Route::post('/update/profile/{id}', 'HomeController@updateProfile');
Route::post('/update/profile/address/{id}', 'HomeController@updateAddress');

//admin=======
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');
// Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password', 'AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update', 'AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

//Admin Section
//Categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/stote/category', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@deletecategory');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@editcategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@updatecategory');

//Brands
// Route::get('admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
// Route::post('admin/stote/brand', 'Admin\Category\BrandController@storebrand')->name('store.brand');
// Route::get('delete/brand/{id}', 'Admin\Category\BrandController@deletebrand');
// Route::get('edit/brand/{id}', 'Admin\Category\BrandController@editbrand');
// Route::post('update/brand/{id}', 'Admin\Category\BrandController@updatebrand');

//Sub Categories
// Route::get('admin/sub/categories', 'Admin\Category\SubCategoryController@subcategory')->name('sub.categories');
// Route::post('admin/stote/sub/category', 'Admin\Category\SubCategoryController@storesubcategory')->name('store.sub.category');
// Route::get('delete/sub/category/{id}', 'Admin\Category\SubCategoryController@deletesubcategory');
// Route::get('edit/sub/category/{id}', 'Admin\Category\SubCategoryController@editsubcategory');
// Route::post('update/sub/category/{id}', 'Admin\Category\SubCategoryController@updatesubcategory');

//Coupons
Route::get('admin/coupons', 'Admin\Category\CouponController@coupon')->name('coupons');
Route::post('admin/stote/coupon', 'Admin\Category\CouponController@storeCoupon')->name('store.coupon');
Route::get('delete/coupon/{id}', 'Admin\Category\CouponController@deleteCoupon');
Route::get('edit/coupon/{id}', 'Admin\Category\CouponController@editCoupon');
Route::post('update/coupon/{id}', 'Admin\Category\CouponController@updateCoupon');


//Newslater
Route::get('admin/newslater', 'Admin\Category\CouponController@newslater')->name('admin.newslater');
Route::get('delete/newslater/{id}', 'Admin\Category\CouponController@deleteNewslater');

//Product
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('admin/product/store', 'Admin\ProductController@store')->name('store.product');
Route::get('delete/product/{id}', 'Admin\ProductController@delete');
Route::get('active/product/{id}', 'Admin\ProductController@active');
Route::get('inactive/product/{id}', 'Admin\ProductController@inactive');
Route::get('edit/product/{id}', 'Admin\ProductController@edit');
Route::post('update/product/withoutphoto/{id}', 'Admin\ProductController@updateWithoutPhoto');
Route::post('update/product/photo/{id}', 'Admin\ProductController@updatePhoto');
Route::get('view/product/{id}', 'Admin\ProductController@view');

//Order
Route::get('admin/pending/order', 'Admin\OrderController@NewOrder')->name('admin.order.new');
Route::get('admin/view/order/{id}', 'Admin\OrderController@ViewOrder');
Route::get('admin/payment/accept/{id}', 'Admin\OrderController@PaymentAccept');
Route::get('admin/payment/cancel/{id}', 'Admin\OrderController@CancelOrder');
Route::get('admin/delevery/process/{id}', 'Admin\OrderController@ProcessOrder');
Route::get('admin/delevery/done/{id}', 'Admin\OrderController@DeliveryOrder');
Route::get('admin/accept/payment', 'Admin\OrderController@AcceptPayment')->name('admin.order.accept');
Route::get('admin/cancel/order', 'Admin\OrderController@OrderCancel')->name('admin.order.cancel');
Route::get('admin/progress/order', 'Admin\OrderController@OrderProgress')->name('admin.order.progress');
Route::get('admin/delivered/order', 'Admin\OrderController@OrderDelivered')->name('admin.order.delivered');


//Blog Admin
Route::get('blog/category/list', 'Admin\PostController@blogCatList')->name('add.blog.categoryList');
Route::post('blog/category/store', 'Admin\PostController@blogCatStore')->name('store.blog.category');
Route::get('delete/blog/category/{id}', 'Admin\PostController@deleteBlogCat');
Route::get('edit/blog/category/{id}', 'Admin\PostController@editBlogCat');
Route::post('update/blog/category/{id}', 'Admin\PostController@updateBlogCat');
Route::get('admin/add/post', 'Admin\PostController@createPost')->name('add.blogpost');
Route::get('admin/all/post', 'Admin\PostController@allPosts')->name('all.blogpost');
Route::post('admin/post/store', 'Admin\PostController@storePost')->name('store.post');
Route::get('delete/post/{id}', 'Admin\PostController@deletePost');
Route::get('edit/post/{id}', 'Admin\PostController@editPost');
Route::post('update/post/{id}', 'Admin\PostController@updatePost');

//SEO
Route::get('admin/seo', 'Admin\OrderController@seo')->name('admin.seo');
Route::post('admin/seo/update', 'Admin\OrderController@seoUpdate')->name('update.seo');

//SubCategory with ajax
// Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getSubCat');

//Fronend
Route::post('stote/newslater', 'FrontController@storeNewslater')->name('store.newslater');
Route::get('view/order/{id}', 'FrontController@ViewOrder');

//wishlist
Route::get('add/wishlist/{id}', 'WishlistController@addWishlist');
Route::get('remove/wishlist/{id}', 'WishlistController@removeWishlist');

//Cart
Route::get('add/cart/{id}', 'CartController@addCart');
Route::get('check', 'CartController@check');
Route::get('product/cart', 'CartController@showCart')->name('show.cart');
Route::get('remove/cart/{rowId}', 'CartController@removeCart');
Route::post('update/cart/item', 'CartController@updateCart')->name('update.cart.item');
Route::get('cart/product/view/{id}', 'CartController@ViewProduct');
Route::post('insert/into/cart/', 'CartController@insertCart')->name('insert.into.cart');
Route::get('user/checkout', 'CartController@checkout')->name('user.checkout');
Route::get('user/wishlist/', 'CartController@wishlist')->name('user.wishlist');

Route::post('user/apply/coupon/', 'CartController@Coupon')->name('apply.coupon');
Route::get('coupon/remove/', 'CartController@CouponRemove')->name('coupon.remove');


//Payment Step
Route::post('payment/process', 'PaymentController@Payment')->name('payment.process');
Route::post('stripe/charge', 'PaymentController@StripeCharge')->name('stripe.charge');

//Product
Route::get('product/details/{id}/{product_name}', 'ProductController@productView');
Route::post('add/cart/product/{id}', 'ProductController@addCart');
Route::get('products', 'ProductController@ProductsView');
Route::get('categories/{id}', 'ProductController@CategoryView');


// Order Tracking Route
Route::post('order/traking', 'FrontController@OrderTraking')->name('order.tracking');

// Order Report Routes 

Route::get('admin/today/order', 'Admin\ReportController@TodayOrder')->name('today.order');
Route::get('admin/today/delivery', 'Admin\ReportController@TodayDelivery')->name('today.delivery');

Route::get('admin/this/month', 'Admin\ReportController@ThisMonth')->name('this.month');
Route::get('admin/search/report', 'Admin\ReportController@Search')->name('search.report');

Route::post('admin/search/by/year', 'Admin\ReportController@SearchByYear')->name('search.by.year');
Route::post('admin/search/by/month', 'Admin\ReportController@SearchByMonth')->name('search.by.month');

Route::post('admin/search/by/date', 'Admin\ReportController@SearchByDate')->name('search.by.date');

// Admin Role Routes 
Route::get('admin/all/user', 'Admin\UserRoleController@UserRole')->name('admin.all.user');

Route::get('admin/create/admin', 'Admin\UserRoleController@UserCreate')->name('create.admin');

Route::post('admin/store/admin', 'Admin\UserRoleController@UserStore')->name('store.admin');

Route::get('delete/admin/{id}', 'Admin\UserRoleController@UserDelete');
Route::get('edit/admin/{id}', 'Admin\UserRoleController@UserEdit');

Route::post('admin/update/admin', 'Admin\UserRoleController@UserUpdate')->name('update.admin');

// Admin Site Setting Route 
Route::get('admin/site/setting', 'Admin\SettingController@SiteSetting')->name('admin.site.setting');

Route::post('admin/sitesetting', 'Admin\SettingController@UpdateSiteSetting')->name('update.sitesetting');

// Return Order Route
Route::get('success/list/', 'PaymentController@SuccessList')->name('success.orderlist');

Route::get('request/return/{id}', 'PaymentController@RequestReturn');

Route::get('admin/return/request/', 'Admin\ReturnController@ReturnRequest')->name('admin.return.request');

Route::get('admin/approve/return/{id}', 'Admin\ReturnController@ApproveReturn');
Route::get('admin/all/return/', 'Admin\ReturnController@AllReturn')->name('admin.all.return');

// Order Stock Route 
Route::get('admin/product/stock', 'Admin\UserRoleController@ProductStock')->name('admin.product.stock');

/// Contact page Routes
Route::get('contact/page', 'ContactController@Contact')->name('contact.page');
Route::post('contact/form', 'ContactController@ContactForm')->name('contact.form');

Route::get('admin/all/message', 'Admin\SettingController@AllMessage')->name('all.message');

// Search Route
Route::post('product/search', 'CartController@Search')->name('product.search');

//Socalize Route
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

//Rating
Route::post('/store/rating/{id}', 'ProductController@storeRating');

