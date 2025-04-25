<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\User;

class UserController extends Controller
{

	public function index()
	{
		Gate::authorize('viewAny', User::class);
		return Inertia::render('admin/Users', [
			'pagination' => Inertia::always(Inertia::merge(User::orderBy(request('sortField', 'created_at'), request('sortDirection', 'desc'))->paginate(request('perPage', 5), "*", null, request('page', 1)))),
		]);
	}
}
