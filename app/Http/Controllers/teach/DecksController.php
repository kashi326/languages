<?php

namespace App\Http\Controllers\Teach;

use App\Decks;
use App\Http\Controllers\Controller;
use App\Language;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Validator;

class DecksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teacher = Teacher::where('user_id', Auth::id())->select('id')->first();
        if(isset($_GET['search']) && $request->ajax()){
            $decks = Decks::where('teacher_id', $teacher->id)->with('deck_lessons')->where('name','like','%'.$_GET['search'].'%')->get();
            return response()->view('teach.decks.list',compact('decks'));
        }
        $decks = Decks::where('teacher_id', $teacher->id)->with('deck_lessons')->get();
        $view = view('teach.decks.list',compact('decks'));
        return view('teach.decks.index',compact(['decks','view']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Language::get();
        return view('teach.decks.create',compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required|max:16',
            'description' => 'required|max:250',
            'language_in' => 'required',
            'language_to' => 'required',
            'level' => 'required',
            'cover' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $teacher = Teacher::where('user_id', Auth::id())->first();
        if ($request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/deck/cover/', $name);
            $image_path = '/deck/cover/' . $name;

            $deck = new Decks;
            $deck->name = strip_tags($request->name);
            $deck->description = strip_tags($request->description);
            $deck->level = $request->level;
            $deck->lang_in_id = $request->language_in;
            $deck->lang_to_id = $request->language_to;
            $deck->cover_image = $image_path;
            $deck->teacher_id = $teacher->id;
            $isCreated = $deck->save();
            if ($isCreated) {
                return response()->json(['message' => 'New Deck created Successfully. please visit deck to add exercises', 'id' => $deck->id], 201);
            } else {
                return response()->json(['message' => 'Hmm, something went wrong. Please try again'], 200);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
