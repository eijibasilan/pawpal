<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	public function index()
	{
		$rows = Service::all();

		return Inertia::render('user/Services', ['services' => $rows]);
	}
}
