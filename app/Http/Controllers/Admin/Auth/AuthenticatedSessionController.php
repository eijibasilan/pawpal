<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{

	public function create(Request $request): Response
	{
		return Inertia::render('admin/index', [
			'canResetPassword' => Route::has('password.request'),
			'status' => $request->session()->get(key: 'status'),
		]);
	}

	public function store(LoginRequest $request): RedirectResponse
	{
		$request->authenticate();

		$request->session()->regenerate();

		return redirect()->intended(route('admin.dashboard', absolute: false));
	}
}
