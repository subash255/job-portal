<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomepageController::class, 'index'])->name('welcome');
Route::get('/about',[HomepageController::class, 'about'])->name('about');
Route::get('/contact',[HomepageController::class, 'contact'])->name('contact');
Route::get('/searchjob',[HomepageController::class, 'job'])->name('job');
Route::get('/job/{id}', [HomepageController::class, 'jobDetail'])->name('job.detail');
Route::post('/apply/{work}', [ApplicantController::class, 'store'])->name('work.apply');
Route::get('/apply/{work}', [ApplicantController::class, 'create'])->name('work.apply.form');


Route::middleware('role:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    // Admin Routes
    Route::get('/admin/employers', [AdminController::class, 'employers'])->name('admin.employers.index');
    Route::get('/admin/jobseekers', [AdminController::class, 'jobseekers'])->name('admin.jobseeker.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Category Routes
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
Route::post('/category/status-toggle/{categoryId}', [CategoryController::class, 'updateToggle'])->name('category.status-toggle');

Route::get('/jobs',[WorkController::class,'index'])->name('admin.jobs.index');
   
    Route::get('/admin/jobs/edit/{id}', [WorkController::class, 'edit'])->name('admin.works.edit');
    Route::post('/admin/jobs/update/{id}', [WorkController::class, 'update'])->name('admin.works.update');
    Route::get('/admin/jobs/delete/{id}', [WorkController::class, 'destroy'])->name('admin.works.delete');

});

Route::middleware('role:user')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/edit-profile', [UserController::class, 'editProfile'])->name('user.edit-profile');
    Route::post('/user/update-profile', [UserController::class, 'updateProfile'])->name('user.update-profile');
    Route::delete('/user/delete-resume', [UserController::class, 'deleteResume'])->name('user.delete-resume');
    Route::get('/user/my-jobs', [UserController::class, 'myJobs'])->name('user.my-jobs');
    Route::get('/user/settings', [UserController::class, 'settings'])->name('user.settings');
    Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('/user/update-notification-settings', [UserController::class, 'updateNotificationSettings'])->name('user.update-notification-settings');
    Route::post('/user/update-privacy-settings', [UserController::class, 'updatePrivacySettings'])->name('user.update-privacy-settings');
    
});

Route::middleware('role:company')->group(function () {
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/jobs', [CompanyController::class, 'jobs'])->name('company.jobs');
    Route::get('/company/applications', [CompanyController::class, 'applications'])->name('company.applications');
    Route::get('/company/profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::get('/company/settings', [CompanyController::class, 'settings'])->name('company.settings');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('work.store');
    Route::get('/company/jobs/{id}/edit', [CompanyController::class, 'edit'])->name('company.jobs.edit');
    Route::put('/company/jobs/{id}', [CompanyController::class, 'update'])->name('company.jobs.update');
    Route::delete('/company/jobs/{id}', [CompanyController::class, 'destroy'])->name('company.jobs.delete');
    Route::put('/company/profile/update', [CompanyController::class, 'profileupdate'])->name('company.profile.update');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
