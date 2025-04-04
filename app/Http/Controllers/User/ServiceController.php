<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	public function index()
	{
		return Inertia::render('user/Services');
	}
}
