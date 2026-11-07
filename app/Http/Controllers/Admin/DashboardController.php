<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index()
    {
        $dashboardData = $this->dashboardService->getDashboardStats();

        return view('admin.dashboard', [
            'stats'           => $dashboardData['stats'],
            'recent_products' => $dashboardData['recent_products'],
        ]);
    }
}
