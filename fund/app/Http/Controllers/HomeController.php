<?php

namespace App\Http\Controllers;
use App\Models\Idea;
use App\Models\Tag;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tags = Tag::all();
        $ideas = Idea::all();

        return view('home', ['ideas' => $ideas,
        'tags' => $tags]);
    }
}
