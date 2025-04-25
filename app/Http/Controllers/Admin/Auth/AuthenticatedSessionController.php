<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{


	public function index()
	{
		return Inertia::render('admin/index', );
	}

	public function create(Request $request): Response
	{
		return Inertia::render('admin/Login', [
			'canResetPassword' => Route::has('password.request'),
			'status' => $request->session()->get(key: 'status'),
		]);
	}

	public function store(LoginRequest $request): RedirectResponse
	{
		$request->authenticate();

		$request->session()->regenerate();

		if (auth()->guard('admin')->user()->hasAnyRole(['Business Admin', 'Admin'])) {
			return redirect()->intended('/admin/dashboard');
		}

		return redirect()->intended('/admin/vet-appointments');
	}

	public function destroy(Request $request): RedirectResponse
	{
		Auth::guard('admin')->logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect('/admin');
	}
}
