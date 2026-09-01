<?php

use App\Http\Controllers\Admin\AccessController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GreetingController;
use App\Http\Controllers\Admin\MediaItemController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProfileSectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BusinessRegistrationController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PublicCatalogController;
use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::post('/language', LocaleController::class)->name('locale.switch');
Route::get('/', HomeController::class)->name('home');
Route::get('/produk', [PublicCatalogController::class, 'products'])->name('public.products.index');
Route::get('/produk/{product:slug}', [PublicCatalogController::class, 'productDetail'])->name('public.products.show');
Route::get('/industri', [PublicCatalogController::class, 'industries'])->name('public.industries.index');
Route::get('/industri/{companyProfile}', [PublicCatalogController::class, 'industryDetail'])->name('public.industries.show');
Route::get('/registrasi', [BusinessRegistrationController::class, 'create'])->name('registration.create');
Route::post('/registrasi', [BusinessRegistrationController::class, 'store'])->name('registration.store');

Route::get('/berita', [\App\Http\Controllers\NewsController::class, 'index'])->name('public.news.index');
Route::get('/berita/{slug}', [\App\Http\Controllers\NewsController::class, 'show'])->name('public.news.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/akun/profil-perusahaan', [CompanyProfileController::class, 'edit'])->name('account.company-profile.edit');
    Route::put('/akun/profil-perusahaan', [CompanyProfileController::class, 'update'])->name('account.company-profile.update');
    Route::get('/akun/produk', [ProductController::class, 'index'])->name('account.products.index');
    Route::get('/akun/produk/tambah', [ProductController::class, 'create'])->name('account.products.create');
    Route::post('/akun/produk', [ProductController::class, 'store'])->name('account.products.store');
    Route::get('/akun/produk/{product}/edit', [ProductController::class, 'edit'])->name('account.products.edit');
    Route::put('/akun/produk/{product}', [ProductController::class, 'update'])->name('account.products.update');
    Route::delete('/akun/produk/{product}', [ProductController::class, 'destroy'])->name('account.products.destroy');

    Route::get('/akun/inquiries', [InquiryController::class, 'index'])->name('account.inquiries.index');
    Route::get('/akun/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('account.inquiries.show');
    Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', DashboardController::class)
            ->middleware('permission:dashboard.view')
            ->name('dashboard');

        Route::get('/business-registrations', [\App\Http\Controllers\Admin\BusinessRegistrationController::class, 'index'])
            ->middleware('permission:users.view')
            ->name('business-registrations.index');
        Route::get('/business-registrations/{businessRegistration}', [\App\Http\Controllers\Admin\BusinessRegistrationController::class, 'show'])
            ->middleware('permission:users.view')
            ->name('business-registrations.show');
        Route::post('/business-registrations/{businessRegistration}/approve', [\App\Http\Controllers\Admin\BusinessRegistrationController::class, 'approve'])
            ->middleware('permission:users.view')
            ->name('business-registrations.approve');
        Route::post('/business-registrations/{businessRegistration}/reject', [\App\Http\Controllers\Admin\BusinessRegistrationController::class, 'reject'])
            ->middleware('permission:users.view')
            ->name('business-registrations.reject');

        Route::resource('users', UserController::class)
            ->middleware('permission:users.view');

        Route::get('/access', [AccessController::class, 'index'])
            ->middleware('permission:roles.view,permissions.view')
            ->name('access.index');

        Route::get('/settings', [SettingController::class, 'edit'])
            ->middleware('permission:settings.view')
            ->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])
            ->middleware('permission:settings.update')
            ->name('settings.update');

        Route::get('/audit-logs', [AuditLogController::class, 'index'])
            ->middleware('permission:audit-logs.view')
            ->name('audit-logs.index');

        Route::resource('categories', CategoryController::class)
            ->except('show')
            ->middleware('permission:categories.manage');
        Route::resource('tags', TagController::class)
            ->except('show')
            ->middleware('permission:tags.manage');
        Route::resource('news', NewsPostController::class)
            ->except('show')
            ->middleware('permission:news.manage');
        Route::resource('pages', StaticPageController::class)
            ->except('show')
            ->middleware('permission:pages.manage');
        Route::resource('media', MediaItemController::class)
            ->except('show')
            ->middleware('permission:media.manage');
        Route::resource('banners', BannerController::class)
            ->except('show')
            ->middleware('permission:banners.manage');
        Route::resource('menus', MenuItemController::class)
            ->except('show')
            ->middleware('permission:menus.manage');
        Route::resource('greetings', GreetingController::class)
            ->except('show')
            ->middleware('permission:greetings.manage');
        Route::resource('profiles', ProfileSectionController::class)
            ->except('show')
            ->middleware('permission:profiles.manage');
        Route::resource('product-categories', ProductCategoryController::class)
            ->except('show')
            ->parameters(['product-categories' => 'productCategory'])
            ->middleware('permission:categories.manage');

        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])
            ->name('products.index');
        Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])
            ->name('products.destroy');
    });
});
