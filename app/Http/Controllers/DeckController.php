<?php

namespace App\Http\Controllers;

use App\Decks;
use App\Language;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    public function index(){
        $decks = Decks::with('deck_lessons')->paginate(8);
        $data['decks'] = $decks;
        return view('user.decks.index',$data);
    }
    public function show($id){
        $deck = Decks::where('id', $id)->with('deck_lessons')->first();
        $data['deck'] = $deck;
        $data['lang_in'] = Language::where("id", $deck->lang_in_id)->first();
        $data['lang_to'] = Language::where("id", $deck->lang_to_id)->first();
        return view('user.decks.view',$data);
    }
}
