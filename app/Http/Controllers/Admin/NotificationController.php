<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class NotificationController extends Controller
{
	public function index()
	{
		$notifications = Admin::find(auth('admin')->user()->id)->unreadNotifications;
		return Inertia::render('admin/Notifications', [
			'notifications' => Inertia::always(Inertia::merge($notifications)),
		]);
	}
}
