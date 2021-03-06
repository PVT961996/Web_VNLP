<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\AppBaseController;

class DashboardController extends AppBaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('superadmin.dashboard.index');
    }
}
