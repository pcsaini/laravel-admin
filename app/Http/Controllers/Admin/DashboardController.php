<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $title = 'Dashboard';
        $active_page = 'dashboard';
        return view('admin.dashboard.index', compact('title', 'active_page'));
    }
}
