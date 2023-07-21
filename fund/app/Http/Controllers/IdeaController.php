<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Validator;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = (int) 5;

        $ideas = Idea::select('ideas.*');
        $ideas = $ideas->paginate($perPage)->withQueryString();

        return view('ideas.index', [
            'ideas' => $ideas,
            'perPage' => $perPage
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        
        return view(
            'ideas.create',
            [
                'users' => $users
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $idea = new Idea;
        $idea->user_id = $request->user_id;
        $idea->description = $request->description;
        $idea->main_image = $request->main_image;
        $idea->save();
        return redirect()->route('ideas-index')->with('success', 'New idea has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        //
    }
}