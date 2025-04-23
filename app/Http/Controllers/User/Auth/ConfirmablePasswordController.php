<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ConfirmablePasswordController extends Controller
{
	/**
	 * Show the confirm password page.
	 */
	public function show(): Response
	{
		return Inertia::render('user/auth/ConfirmPassword');
	}

	/**
	 * Confirm the user's password.
	 */
	public function store(Request $request): RedirectResponse
	{
		if (
			!Auth::guard('user')->validate([
				'email' => $request->user()->email,
				'password' => $request->password,
			])
		) {
			throw ValidationException::withMessages([
				'password' => __('user.auth.password'),
			]);
		}

		$request->session()->put('auth.password_confirmed_at', time());

		return redirect()->intended(route('home', absolute: false));
	}
}
