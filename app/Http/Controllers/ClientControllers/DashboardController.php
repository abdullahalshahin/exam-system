<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Models\ExamPaper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('client_panel.dashboard.index');
    }
}
