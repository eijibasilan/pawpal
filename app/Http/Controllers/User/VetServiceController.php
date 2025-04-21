<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\VetService;
use Inertia\Inertia;

class VetServiceController extends Controller
{
	public function index()
	{
		$rows = VetService::with('uploads', 'types')->get();

		return Inertia::render('user/VetServices', ['vetServices' => $rows]);
	}
}
