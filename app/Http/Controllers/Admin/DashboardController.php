<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'users' => User::where('role', 'user')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'groups' => 
        ]);
    }
}
