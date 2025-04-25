<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Inertia\Inertia;
use App\Http\Controllers\Controller;


class NotificationController extends Controller
{
	public function index()
	{
		$notifications = User::find(auth('user')->user()->id)->unreadNotifications;

		return Inertia::render('user/Notifications', [
			'notifications' => Inertia::always(Inertia::merge($notifications)),
		]);
	}
}
