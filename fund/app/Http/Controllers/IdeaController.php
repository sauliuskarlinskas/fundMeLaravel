<?php

namespace App\Http\Controllers;

use App\Models\IdeaTag;
use App\Models\User;
use App\Models\Idea;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        $ideas = Idea::all();

        // $ideas = $ideas->paginate(5)->withQueryString();

        return view('ideas.index', [
            'ideas' => $ideas,
            'tags' => $tags
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


        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|string|max:1000',
                'main_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'img_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'img_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'img_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'img_4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'money_need' => 'required|numeric|min:1',
            ],
            [
                'description.required' => 'Please enter description of your idea!',
                'description.max' => 'The description cannot be more than 1000 characters.',
                'main_image.required' => 'Please upload a picture!',
                'money_need.required' => 'Please enter the amount you wish to get!'
            ]
        );

        // If validation fails, redirect back with error messages
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $idea = new Idea();
        $idea->user_id = $request->user_id;
        $idea->description = $request->description;

        $idea->main_image = $this->saveImage($request->file('main_image'));
        $idea->img_1 = $this->saveImage($request->file('img_1'));
        $idea->img_2 = $this->saveImage($request->file('img_2'));
        $idea->img_3 = $this->saveImage($request->file('img_3'));
        $idea->img_4 = $this->saveImage($request->file('img_4'));

        $idea->money_need = $request->money_need;
        $idea->money_got = 0;
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
                'description' => 'required|string|max:1000',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'money_need' => 'required|numeric|min:1',
            ],
            [
                'description.required' => 'Please enter description of your idea!',
                'description.max' => 'The description cannot be more than 1000 characters.',
                'main_image.required' => 'Please upload a picture!',
                'money_need.required' => 'Please enter the amount you wish to get!'
            ]
        );


        if ($request->hasFile('main_image')) {
            $idea->main_image = $this->saveImage($request->file('main_image'));
        }


        if ($request->has('remove_img_1')) {
            Storage::delete($idea->img_1);
            $idea->img_1 = null;
        }
        if ($request->has('remove_img_2')) {
            Storage::delete($idea->img_2);
            $idea->img_2 = null;
        }
        if ($request->has('remove_img_3')) {
            Storage::delete($idea->img_3);
            $idea->img_3 = null;
        }
        if ($request->has('remove_img_4')) {
            Storage::delete($idea->img_4);
            $idea->img_4 = null;
        }

        if ($request->hasFile('img_1')) {
            $idea->img_1 = $this->saveImage($request->file('img_1'));
        }
        if ($request->hasFile('img_2')) {
            $idea->img_2 = $this->saveImage($request->file('img_2'));
        }
        if ($request->hasFile('img_3')) {
            $idea->img_3 = $this->saveImage($request->file('img_3'));
        }
        if ($request->hasFile('img_4')) {
            $idea->img_4 = $this->saveImage($request->file('img_4'));
        }

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // ->withInput()

        $idea->user_id = $request->user_id;
        $idea->description = $request->description;
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

    public function addTag(Request $request, Idea $idea)
    {

        $ideaId = $idea->id;
        $tagId = $request->tag_id ?? null;


        $validator = Validator::make(
            $request->all(),
            [
                'tag_id' => [
                    'required',
                    Rule::unique('idea_tags')->where(function ($query) use ($ideaId, $tagId) {
                        return $query->where('idea_id', $ideaId)
                            ->where('tag_id', $tagId);
                    }),
                ],
            ],
            [
                'tag_id.required' => 'Please select tag!',
                'tag_id.unique' => 'Tag already exists!',
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $ideaTag = new IdeaTag;
        $ideaTag->idea_id = $idea->id;
        $ideaTag->tag_id = $request->tag_id;
        $ideaTag->save();
        return redirect()->back()->with('success', 'Tag has been added!');
    }

    public function removeTag(Idea $idea, Tag $tag)
    {
        $ideaTag = IdeaTag::where('idea_id', $idea->id)
            ->where('tag_id', $tag->id)
            ->first();
        $ideaTag->delete();
        return redirect()->back()->with('success', 'Tag has been removed!');
    }

    public function createTag(Request $request, Idea $idea)
    {

        $ideaId = $idea->id;
        $tagName = $request->tag_name ?? null;


        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => [
                    'required',
                    'max:50',
                    'min:3',
                ],
            ],
            [
                'tag_name.required' => 'Please enter tag name!',
                'tag_name.max' => 'Tag name is too long!',
                'tag_name.min' => 'Tag name is too short!',
            ]
        );


        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $tag = Tag::firstOrCreate([
            'name' => $tagName
        ]);


        $ideaTag = new IdeaTag;
        $ideaTag->idea_id = $ideaId;
        $ideaTag->tag_id = $tag->id;
        $ideaTag->save();
        return redirect()->back()->with('success', 'Tag has been added!');
    }

    public function donate(Idea $idea)
    {

        return view(
            'ideas.donate',
            [
                'idea' => $idea
            ]
        );

    }
    public function addmoney(Request $request, Idea $idea)
    {

        $amount = $request->amount;

        $validator = Validator::make(
            $request->all(),
            [
                'amount' => 'required|integer|min:0'
            ],
            [
                'amount.required' => 'Please enter the amount!',
                'amount.integer' => 'The amount has to be integer!',
                'amount.min' => 'The amount must be a positive integer!'
            ]
        );

        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        // Check if the new donation amount doesn't exceed the remaining money needed.
        // $remainingMoneyNeeded = $idea->money_need - $idea->money_got;
        // if ($amount > $remainingMoneyNeeded) {
        //     return redirect()->back()->withErrors(['amount' => 'The amount exceeds the remaining money needed.']);
        // }

        if ($request->has('add')) {
            $amount = $request->input('amount');

            $idea->money_got += $amount;

            $idea->save();
            return redirect()
                ->route('home')
                ->with('success', ' Thank you for your kindness!');
        }


    }

    public function addLove(Request $request, Idea $idea)
    {
        // Get the current love count from the idea
        $currentLoveCount = $idea->love;

        // Increment the love count by 1
        $idea->love = $currentLoveCount + 1;

        // Save the updated idea to the database
        $idea->save();

        // Redirect back to the page after giving the heart
        return redirect()->back()->with('success', 'Heart has been added!');
    }


    private function saveImage($imageFile)
    {
        if (!$imageFile) {
            return null;
        }

        $imagePath = $imageFile->store('public/images');
        $imageFileName = basename($imagePath);
        return 'storage/images/' . $imageFileName;
    }

}