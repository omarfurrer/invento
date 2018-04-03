<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller {

    /**
     * Return dashboard view.
     * 
     * @return \Illuminate\View\View
     */
    public function getDashboard()
    {
        return view("pages.dashboard");
    }

}
