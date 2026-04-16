<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SystemAuth;
use App\Http\Middleware\CheckSystemAuth;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\LoginAuth;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\IntroduceController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientWeddingController;
use App\Http\Controllers\Client\ClientVideoController;
use App\Http\Controllers\Client\ClientIntroduceController;
use App\Http\Controllers\Client\ClientAlbumController;
use App\Http\Controllers\Client\ClientBlogController;
use App\Http\Controllers\Client\ClientFaqController;

Route::group(['middleware' => [SystemAuth::class]], function () {
    Route::group(['middleware' => [AdminAuth::class]], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin');
        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
        // Slider
        Route::get('/admin/slider', [SliderController::class, 'show'])->name('list_slider');
        Route::get('/admin/slider/add', [SliderController::class, 'add'])->name('add_slider');
        Route::post('/admin/slider/save', [SliderController::class, 'save'])->name('save_slider');
        Route::post('/admin/slider/delete', [SliderController::class, 'delete'])->name('delete_slider');
        Route::get('/admin/slider/edit/{id}', [SliderController::class, 'edit'])->name('edit_slider');
        // Wedding
        Route::get('/admin/wedding', [WeddingController::class, 'show'])->name('list_wedding');
        Route::get('/admin/wedding/add', [WeddingController::class, 'add'])->name('add_wedding');
        Route::post('/admin/wedding/save', [WeddingController::class, 'save'])->name('save_wedding');
        Route::post('/admin/wedding/delete', [WeddingController::class, 'delete'])->name('delete_wedding');
        Route::get('/admin/wedding/edit/{id}', [WeddingController::class, 'edit'])->name('edit_wedding');
        Route::get('/admin/wedding/search', [WeddingController::class, 'search'])->name('search_wedding');
        Route::post('/admin/wedding/delete-wedding-photo', [WeddingController::class, 'deleteWeddingPhoto'])->name('delete_wedding_photo');
        // Công ty
        Route::get('/admin/company', [CompanyController::class, 'show'])->name('company');
        Route::post('/admin/company/save', [CompanyController::class, 'save'])->name('save_company');
        // Giới thiệu
        Route::get('/admin/introduce', [IntroduceController::class, 'show'])->name('introduce');
        Route::post('/admin/introduce/save', [IntroduceController::class, 'save'])->name('save_introduce');
        // Video
        Route::get('/admin/video', [VideoController::class, 'show'])->name('list_video');
        Route::get('/admin/video/add', [VideoController::class, 'add'])->name('add_video');
        Route::post('/admin/video/save', [VideoController::class, 'save'])->name('save_video');
        Route::post('/admin/video/delete', [VideoController::class, 'delete'])->name('delete_video');
        Route::get('/admin/video/edit/{id}', [VideoController::class, 'edit'])->name('edit_video');
        Route::get('/admin/video/search', [VideoController::class, 'search'])->name('search_video');
        // Album
        Route::get('/admin/album', [AlbumController::class, 'show'])->name('list_album');
        Route::get('/admin/album/add', [AlbumController::class, 'add'])->name('add_album');
        Route::post('/admin/album/save', [AlbumController::class, 'save'])->name('save_album');
        Route::post('/admin/album/delete', [AlbumController::class, 'delete'])->name('delete_album');
        Route::get('/admin/album/edit/{id}', [AlbumController::class, 'edit'])->name('edit_album');
        Route::get('/admin/album/search', [AlbumController::class, 'search'])->name('search_album');
        Route::post('/admin/album/delete-album-photo', [AlbumController::class, 'deleteAlbumPhoto'])->name('delete_album_photo');
        // Blog
        Route::get('/admin/blog', [BlogController::class, 'show'])->name('list_blog');
        Route::get('/admin/blog/add', [BlogController::class, 'add'])->name('add_blog');
        Route::post('/admin/blog/save', [BlogController::class, 'save'])->name('save_blog');
        Route::post('/admin/blog/delete', [BlogController::class, 'delete'])->name('delete_blog');
        Route::get('/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('edit_blog');
        Route::get('/admin/blog/search', [BlogController::class, 'search'])->name('search_blog');
        // Contact
        Route::get('/admin/contact', [ContactController::class, 'show'])->name('list_contact');
        Route::get('/admin/contact/view/{id}', [ContactController::class, 'viewContact'])->name('view_contact');
        Route::get('/admin/contact/search', [ContactController::class, 'search'])->name('search_contact');
        // FAQ
        Route::get('/admin/faq', [FaqController::class, 'show'])->name('faq');
        Route::post('/admin/faq/save', [FaqController::class, 'save'])->name('save_faq');
    });
    Route::group(['middleware' => [LoginAuth::class]], function () {
        Route::get('/admin/login', function () {return view('admin.login');})->name('login');
        Route::post('/admin/login', [AdminController::class, 'login'])->name('login');
    });

    Route::middleware([SetLocale::class])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/search', [ClientWeddingController::class, 'search'])->name('search');
        Route::get('/wedding', [ClientWeddingController::class, 'show'])->name('wedding');
        Route::get('/wedding/{slug}', [ClientWeddingController::class, 'detail'])->name('wedding_detail');
        Route::get('/video', [ClientVideoController::class, 'show'])->name('video');
        Route::get('/video/{slug}', [ClientVideoController::class, 'detail'])->name('video_detail');
        Route::get('/gioi-thieu', [ClientIntroduceController::class, 'show'])->name('introduce_detail');
        Route::get('/album', [ClientAlbumController::class, 'show'])->name('album');
        Route::get('/album/{slug}', [ClientAlbumController::class, 'detail'])->name('album_detail');
        Route::get('/blog', [ClientBlogController::class, 'show'])->name('blog');
        Route::get('/blog/{slug}', [ClientBlogController::class, 'detail'])->name('blog_detail');
        Route::post('/', [HomeController::class, 'sendContact'])->name('send_contact');
        Route::get('/faq', [ClientFaqController::class, 'show'])->name('faq_detail');
    });

    Route::get('/change-language/{lang}', function ($lang) {
        if (!in_array($lang, ['vi', 'en'])) {
            abort(404);
        }
        session(['app_locale' => $lang]);
        return redirect()->back();
    })->name('change.language');
});

Route::group(['middleware' => [CheckSystemAuth::class]], function () {
    Route::get('/system', [SystemController::class, 'index'])->name('system');
    Route::post('/system', [SystemController::class, 'save'])->name('save_system');
});
