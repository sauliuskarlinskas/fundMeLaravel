<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\Tag;

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
        $ideas = Idea::orderByDesc('love')->paginate(5);

        $approvedIdeas = $ideas->where('approved', true);
        $ideaCount = $approvedIdeas->count();

        return view('home', [
            'ideas' => $ideas,
            'tags' => $tags,
            'ideaCount' => $ideaCount
        ]);
    }
}