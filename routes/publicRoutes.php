<?php
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

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

Route::get('/vet-medicines', function () {
	return Inertia::render('VetMedicines');
})->name('vet-medicines');

Route::get('/secretary', function () {
	return Inertia::render('Secretary');
})->name('secretary');

Route::get('/sitemap', function () {
	return Inertia::render('Sitemap');
})->name('sitemap');