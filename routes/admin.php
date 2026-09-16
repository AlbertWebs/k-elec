<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CarouselSlideController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ShowroomController;
use App\Http\Controllers\Admin\HomepageVideoController;
use App\Http\Controllers\Admin\BrandShopController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogSettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\VendorController;


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    Route::post('products/bulk-action', [ProductController::class, 'bulkAction'])->name('products.bulk-action');
    Route::post('products/upload-image', [ProductController::class, 'uploadImage'])->name('products.upload-image');
    Route::post('products/test-update', [ProductController::class, 'testUpdate'])->name('products.test-update');
    Route::resource('products', ProductController::class);
    
    // Categories
    Route::resource('categories', CategoryController::class);
    Route::post('categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');
    
    // Users
    Route::resource('users', UserController::class);
    Route::post('users/bulk-action', [UserController::class, 'bulkAction'])->name('users.bulk-action');
    
    // Orders
    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.update-payment-status');
    
    // FAQs
    Route::resource('faqs', FaqController::class);
    Route::patch('faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faqs.toggle-status');
    
    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::patch('contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('contact-messages.update-status');
    Route::patch('contact-messages/{contactMessage}/notes', [ContactMessageController::class, 'updateNotes'])->name('contact-messages.update-notes');
    Route::post('contact-messages/mark-all-read', [ContactMessageController::class, 'markAllAsRead'])->name('contact-messages.mark-all-read');
    
    // Subscriptions
    Route::resource('subscriptions', SubscriptionController::class)->only(['index', 'show', 'destroy']);
    Route::patch('subscriptions/{subscription}/status', [SubscriptionController::class, 'updateStatus'])->name('subscriptions.update-status');
    Route::patch('subscriptions/{subscription}/notes', [SubscriptionController::class, 'updateNotes'])->name('subscriptions.update-notes');
    Route::post('subscriptions/mark-all-read', [SubscriptionController::class, 'markAllRead'])->name('subscriptions.mark-all-read');
    
    // Vendors
    Route::resource('vendors', VendorController::class)->only(['index', 'show', 'destroy']);
    Route::patch('vendors/{vendor}/status', [VendorController::class, 'update'])->name('vendors.update-status');
    Route::get('vendors/filter/approved', [VendorController::class, 'approved'])->name('vendors.approved');
    
    // Brand Shops
    Route::resource('brand-shops', BrandShopController::class);
    Route::patch('brand-shops/{brandShop}/toggle-status', [BrandShopController::class, 'toggleStatus'])->name('brand-shops.toggle-status');
    Route::post('brand-shops/reorder', [BrandShopController::class, 'updateOrder'])->name('brand-shops.reorder');
    
    // Carousel Slides
    Route::resource('carousel-slides', CarouselSlideController::class);
    Route::patch('carousel-slides/{carouselSlide}/toggle-status', [CarouselSlideController::class, 'toggleStatus'])->name('carousel-slides.toggle-status');
    Route::post('carousel-slides/reorder', [CarouselSlideController::class, 'updateOrder'])->name('carousel-slides.reorder');

    // Banners
    Route::resource('banners', BannerController::class);
    Route::patch('banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
    Route::post('banners/reorder', [BannerController::class, 'updateOrder'])->name('banners.reorder');

    // Homepage Video
    Route::get('homepage-video', [HomepageVideoController::class, 'edit'])->name('homepage-video.edit');
    Route::put('homepage-video', [HomepageVideoController::class, 'update'])->name('homepage-video.update');
    Route::patch('homepage-video/toggle', [HomepageVideoController::class, 'toggle'])->name('homepage-video.toggle');

     // Showrooms
    Route::resource('showrooms', ShowroomController::class);
    Route::patch('showrooms/{showroom}/toggle-status', [ShowroomController::class, 'toggleStatus'])->name('showrooms.toggle-status');
    Route::post('showrooms/reorder', [ShowroomController::class, 'updateOrder'])->name('showrooms.reorder');

    // Blog Posts
    Route::resource('blog-posts', BlogPostController::class);
    Route::patch('blog-posts/{blogPost}/toggle-publish', [BlogPostController::class, 'togglePublish'])->name('blog-posts.toggle-publish');
    Route::post('blog-posts/reorder', [BlogPostController::class, 'updateOrder'])->name('blog-posts.reorder');

    // Blog Settings
    Route::get('blog-settings', [BlogSettingController::class, 'edit'])->name('blog-settings.edit');
    Route::put('blog-settings', [BlogSettingController::class, 'update'])->name('blog-settings.update');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/contact', [SettingController::class, 'contact'])->name('settings.contact');
    Route::get('settings/social', [SettingController::class, 'social'])->name('settings.social');
}); 


