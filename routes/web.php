<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::middleware('web')->prefix(config('jen.route_prefix', ''))->get('/jen-ui/spotlight', function (Request $request) {
	$search = $request->get('search', '');

	// Sample search data for demo
	$items = collect([
		[
			'name' => 'Dashboard',
			'description' => 'Main application dashboard',
			'link' => '/',
			'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v0M8 11h8m-8 4h6"></path></svg>',
			'avatar' => null,
		],
		[
			'name' => 'Settings',
			'description' => 'Application settings and configuration',
			'link' => '/settings',
			'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
			'avatar' => null,
		],
		[
			'name' => 'User Profile',
			'description' => 'Manage your profile information',
			'link' => '/profile',
			'icon' => null,
			'avatar' => 'https://ui-avatars.com/api/?name=User+Profile&background=0ea5e9&color=fff',
		],
		[
			'name' => 'Admin Panel',
			'description' => 'Administrative functions and controls',
			'link' => '/admin',
			'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
			'avatar' => null,
		],
		[
			'name' => 'Documentation',
			'description' => 'API and component documentation',
			'link' => '/docs',
			'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>',
			'avatar' => null,
		],
	]);

	if (empty($search)) {
		return response()->json([]);
	}

	$results = $items->filter(function ($item) use ($search) {
		return str_contains(strtolower($item['name']), strtolower($search)) ||
			str_contains(strtolower($item['description']), strtolower($search));
	});

	return response()->json($results->values());
})->name('jen.spotlight');

Route::middleware(['web', 'auth'])->prefix(config('jen.route_prefix', ''))->post('/jen-ui/upload', function (Request $request) {
	$disk = $request->disk ?? 'public';
	$folder = $request->folder ?? 'jen-ui';

	$file = Storage::disk($disk)->put($folder, $request->file('file'), 'public');

	$url = $disk === 'public'
		? Storage::url($file)
		: $file;

	return ['location' => $url];
})->name('jen.upload');
