<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
	/**
	 * Mark the authenticated user's email address as verified.
	 */
	public function __invoke(EmailVerificationRequest $request): RedirectResponse
	{
		if ($request->user()->hasVerifiedEmail()) {
			//return redirect()->intended(route('', absolute: false) . '?verified=1');
			return redirect()->intended('/admin/admins');
		}

		if ($request->user()->markEmailAsVerified()) {
			/** @var \Illuminate\Contracts\Auth\MustVerifyEmail $admin */
			$admin = $request->user();
			event(new Verified($admin));
		}

		//return redirect()->intended(route('', absolute: false) . '?verified=1');
		return redirect()->intended('/admin/admins');
	}
}
