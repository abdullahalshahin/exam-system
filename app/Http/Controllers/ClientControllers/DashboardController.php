<?php

namespace App\Http\Controllers\ClientControllers;

use App\Http\Controllers\Controller;
use App\Models\ExamPaper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $exam_papers = ExamPaper::query()
            ->where('status', "active")
            ->latest()
            ->get();

        return view('client_panel.dashboard.index', compact('exam_papers'));
    }
}
