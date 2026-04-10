<?php

namespace App\Http\Controllers;
use App\Services\DashboardService;


class DashboardController extends Controller
{
    public function __construct(DashboardService $dashboardService){
        $this->dashboardService = $dashboardService;
    }
    public function index(){
      $stats = $this->dashboardService->getStats();
      return view('dashboard.index', compact('stats'));
    }
}
