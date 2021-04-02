<?php

namespace App\Http\Controllers;

use App\Gifts;
use App\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.gifts.index');
    }
    public function buy()
    {
        return view('user.gifts.purchase');
    }
    public function checkout()
    {
        return view('user.gifts.checkout');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gifts = new gifts;
        $gifts->user_id= auth()->user()->id;
        $reciever =DB::table('users')->where('email', $request->email)->value('id');
       
        if($reciever){
        $gifts->reciever_id=$reciever;

    }
    
        $gifts->reciever_email= $request->email;
        $gifts->message= $request->message;
        $gifts->amount= $request->amount;
        $gifts->status= 'created';
        $gifts->save();
        return view('user.gifts.checkout')->with(['req' => $request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gifts  $gifts
     * @return \Illuminate\Http\Response
     */
    public function show(Gifts $gifts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gifts  $gifts
     * @return \Illuminate\Http\Response
     */
    public function edit(Gifts $gifts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gifts  $gifts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gifts $gifts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gifts  $gifts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gifts $gifts)
    {
        //
    }
}
