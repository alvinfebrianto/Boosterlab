<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman FAQ
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('faq');
    }

    /**
     * Menampilkan halaman FAQ untuk admin
     *
     * @return \Illuminate\View\View
     */
    public function adminFAQ()
    {
        return view('admin.faq');
    }
}