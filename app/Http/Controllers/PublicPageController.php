<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicPageController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function faqs() {
        return view('faqs');
    }

    public function about_us() {
        return view('about_us');
    }

    public function contact_us() {
        return view('contact_us');
    }
}
