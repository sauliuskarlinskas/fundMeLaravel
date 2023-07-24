<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
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
    //    $imagePath = Storage::disk('public')->url('images/' . $imageFileName);
       $imagePath = 'storage/images/' . $imageFileName;
   } else {
       $imagePath = null;
   }


    
        // If validation fails, redirect back with error messages
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idea = new Idea();
        $idea->user_id = $request->user_id;
        $idea->description = $request->description;
        $idea->main_image = $imagePath;
        $idea->money_need = $request->money_need;
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