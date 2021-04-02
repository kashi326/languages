<?php

namespace App\Http\Controllers\Teach;

use App\DeckLessons;
use App\Decks;
use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;
use \Validator;

class DeckLessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'cover' => 'required|mimes:jpeg,png,jpg,svg|max:2048',
            'audio' => 'required|mimes:mpga,wav,mp3,m4a|max:1024', ['audio.required' => 'Audio file is required', 'audio.mimes' => 'Audio file must be of type MP3,M4A,WAV,MPGA', 'audio.max' => 'Audio File must be less than 1Mb']
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        if ($request->hasFile('audio') && $request->hasFile('cover')) {
            $image = $request->file('cover');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/deck/lessons/cover/', $name);
            $image_path = '/deck/lessons/cover/' . $name;

            $audio = $request->file('audio');
            $audio_name = time() . '.' . $audio->getClientOriginalExtension();
            $audio->move(public_path() . '/deck/lessons/audio/', $audio_name);
            $audio_path = '/deck/lessons/audio/' . $audio_name;

            $deckLesson = new DeckLessons;
            $deckLesson->name = strip_tags($request->title);
            if ($request->translation !== '') {
                $deckLesson->translation = strip_tags($request->translation);
            } else {

                $deckLesson->translation = '';
            }
            $deckLesson->cover = $image_path;
            $deckLesson->audio = $audio_path;
            $deckLesson->deck_id = $request->deckID;
            $created = $deckLesson->save();
            if ($created)
                return response()->json(['message' => 'Lesson added to Deck Successfully'], 201);
            return response()->json(['message' => 'Hmm, Something went wrong. Please try again'], 200);
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
        $deck = Decks::where('id', $id)->with('deck_lessons')->first();
        $data['deck'] = $deck;
        $data['lang_in'] = Language::where("id", $deck->lang_in_id)->first();
        $data['lang_to'] = Language::where("id", $deck->lang_to_id)->first();
        return view("teach.decks.edit", $data);
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
        $lesson = DeckLessons::find($id);
        if (file_exists(public_path($lesson->audio))) {
            unlink(public_path($lesson->audio));
        }
        if (file_exists(public_path($lesson->cover))) {
            unlink(public_path($lesson->cover));
        }
        $lesson->delete();
        return response($id, 200);
    }
}
