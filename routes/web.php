<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PortfolioController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SkillCategoryController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\PortfolioCategoryController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\PortfolioImageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialMediaController;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Auth Routes
Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Hero
        Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
        Route::post('/hero', [HeroController::class, 'store'])->name('hero.store');

        // About
        Route::get('/about', [AboutController::class, 'index'])->name('about.index');
        Route::post('/about', [AboutController::class, 'store'])->name('about.store');

        // Services
        Route::resource('services', ServiceController::class);

        // Skills
        Route::resource('skill-categories', SkillCategoryController::class);
        Route::resource('skills', SkillController::class);

        // Experience
        Route::resource('experiences', ExperienceController::class);

        // Education
        Route::resource('educations', EducationController::class);

        // Portfolio
        Route::resource('portfolio-categories', PortfolioCategoryController::class);
        Route::resource('portfolios', AdminPortfolioController::class);
        Route::delete('/portfolio-images/{image}', [PortfolioImageController::class, 'destroy'])->name('portfolio-images.destroy');

        // Gallery
        Route::resource('galleries', GalleryController::class);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class);

        // Achievements
        Route::resource('achievements', AchievementController::class);

        // FAQ
        Route::resource('faqs', FaqController::class);

        // Blog
        Route::resource('blog-categories', BlogCategoryController::class);
        Route::resource('tags', TagController::class);
        Route::resource('blogs', AdminBlogController::class);

        // Messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');

        // Social Media
        Route::get('/social-media', [SocialMediaController::class, 'index'])->name('social-media.index');
        Route::put('/social-media/{socialMedia}', [SocialMediaController::class, 'update'])->name('social-media.update');
    });
});

require __DIR__.'/auth.php';
