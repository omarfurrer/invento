<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller {

    /**
     * @var DashboardService 
     */
    protected $dashboardService;

    /**
     * DashboardController Constructor.
     * 
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Get the dashboard view and its data.
     * 
     * @return /Illuminate\View\View
     */
    public function getDashboard()
    {
        $lowQuantityItems = $this->dashboardService->getLowQuantityItems();
        return view('pages.dashboard', compact('lowQuantityItems'));
    }

}
