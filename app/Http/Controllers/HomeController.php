<?php

namespace App\Http\Controllers;


class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Show forms to save
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('create');
    }
}
