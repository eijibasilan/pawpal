<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\User\VetServiceController as UserVetServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Welcome');
})->name('home');

Route::get('/about-us', function () {
	return Inertia::render('About');
})->name('about');

Route::get('/prescription', function () {
	return Inertia::render('Prescription');
})->name('prescription');

Route::get('/help-centre', function () {
	return Inertia::render('HelpCentre');
})->name('help-centre');

Route::get('/contact', function () {
    return Inertia::render('ContactUs');
})->name('contact');

Route::get('/faq', function () {
    return Inertia::render('FAQ');
})->name('faq');

Route::get('/how-to-register-your-pet', function () {
    return Inertia::render('HowToRegisterPet');
})->name('how-to-register-your-pet');

Route::get('/terms-of-use', function () {
    return Inertia::render('TermsOfUse');
})->name('terms-of-use');

Route::get('/terms-and-conditions', function () {
    return Inertia::render('TermsAndConditions');
})->name('terms-and-conditions');

Route::get('/cookie-policy', function () {
    return Inertia::render('CookiePolicy');
})->name('cookie-policy');

Route::get('/privacy-policy', function () {
    return Inertia::render('PrivacyPolicy');
})->name('privacy-policy');

Route::prefix('user')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('user/Dashboard');
	})->middleware(['auth', 'verified'])->name('user.dashboard');

	Route::prefix('vet-services')->group(function () {
		Route::get('/', [UserVetServiceController::class, 'index'])->name('user.services');
	});

	require __DIR__ . '/user/auth.php';
	require __DIR__ . '/user/settings.php';
});


Route::prefix('admin')->group(function () {
	Route::get('dashboard', function () {
		return Inertia::render('admin/Dashboard');
	})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

	require __DIR__ . '/admin/auth.php';

	Route::middleware('auth:admin')->group(function () {
		Route::apiResource('roles', RoleController::class)->except('show');
		Route::apiResource('accounts', AdminController::class)->except('show');

		require __DIR__ . '/admin/vetServices.php';
		require __DIR__ . '/admin/settings.php';
		require __DIR__ . '/admin/inventory.php';
	});

});

Route::get('/vet-medicines', function () {
    return Inertia::render('VetMedicines');
})->name('vet-medicines');

Route::get('/secretary', function () {
    return Inertia::render('Secretary');
})->name('secretary');

Route::get('/sitemap', function () {
    return Inertia::render('Sitemap');
})->name('sitemap');