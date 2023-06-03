<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('faq');
    }

    public function adminFAQ()
    {
        return view('admin.faq');
    }
}
