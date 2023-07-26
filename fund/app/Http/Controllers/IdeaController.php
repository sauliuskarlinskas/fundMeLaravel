<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to create an idea.');
        }

        // Get the currently logged-in user
        $user = Auth::user();

        // Check if the user already has an idea
        if ($user->ideas()->exists()) {
            // You can redirect them to a different page or display an error message.
            return redirect()->route('ideas-index')->with('error', 'You can create only one idea.');
        }

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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to create an idea.');
        }

        // $user = Auth::user();
        // // Check if the user already has an idea
        // if ($user->ideas()->exists()) {
        //     // You can redirect them to a different page or display an error message.
        //     return redirect()->route('ideas-index')->with('error', 'You can create only one idea.');
        // }

        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'money_need' => 'required|numeric|min:1',
            ],
            [
                'description.required' => 'Please enter description of your idea!',
                'main_image.required' => 'Please upload a picture!',
                'money_need.required' => 'Please enter the amount you wish to get!'
            ]
        );

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imagePath = $image->store('public/images');
            // Get the image filename from the storage path.
            $imageFileName = basename($imagePath);

            // Update the image path to use the public disk for proper URL generation.

            $imagePath = 'storage/images/' . $imageFileName;
        } else {
            $imagePath = null;
        }

        // If validation fails, redirect back with error messages
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $idea = new Idea();
        $idea->user_id = $request->user_id;
        $idea->description = $request->description;
        $idea->main_image = $imagePath;
        $idea->money_need = $request->money_need;
        $idea->love = 0;
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
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to edit an idea.');
        }

        // Check if the authenticated user is the creator of the idea
        if (Auth::user()->id !== $idea->user_id) {
            return redirect()->route('ideas-index')->with('error', 'You are not authorized to edit this idea.');
        }


        $users = User::all();

        return view(
            'ideas.edit',
            [
                'idea' => $idea,
                'users' => $users
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Idea $idea)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'money_need' => 'required|numeric|min:1',
            ],
            [
                'description.required' => 'Please enter description of your idea!',
                'main_image.required' => 'Please upload a picture!',
                'money_need.required' => 'Please enter the amount you wish to get!'
            ]
        );

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image');
            $imagePath = $image->store('public/images');
            $imageFileName = basename($imagePath);


            $imagePath = 'storage/images/' . $imageFileName;
        } else {
            $imagePath = null;
        }

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // ->withInput()

        $idea->user_id = $request->user_id;
        $idea->description = $request->description;
        $idea->main_image = $imagePath;
        $idea->money_need = $request->money_need;
        $idea->save();
        return redirect()->route('ideas-index')->with('success', 'Idea has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function delete(Idea $idea)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to delete an idea.');
        }

        // Check if the authenticated user is the creator of the idea
        if (Auth::user()->id !== $idea->user_id) {
            return redirect()->route('ideas-index')->with('error', 'You are not authorized to delete this idea.');
        }


        return view('ideas.delete', [
            'idea' => $idea
        ]);
    }

    public function destroy(Idea $idea)
    {
        // Check if the user is authorized to delete the idea
        if (Gate::denies('delete-idea', $idea)) {
            return redirect()->route('ideas-index')->with('error', 'You are not authorized to delete this idea.');
        }

        $idea->delete();
        return redirect()
            ->route('ideas-index')
            ->with('success', 'Idea has been deleted!');
    }
}