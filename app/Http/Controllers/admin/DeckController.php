<?php

namespace App\Http\Controllers\Admin;

use App\Decks;
use App\Language;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    public function index(){
        $decks = Decks::with('teacher','language_in','language_to')->paginate(15);
        // dd($decks);
        return view('admin.decks.index')->with('decks',$decks );
    }
    public function show($id){
        $deck = Decks::where('id', $id)->with('deck_lessons')->first();
        $data['deck'] = $deck;
        $data['lang_in'] = Language::where("id", $deck->lang_in_id)->first();
        $data['lang_to'] = Language::where("id", $deck->lang_to_id)->first();
        return view('admin.decks.view',$data);
    }
}
