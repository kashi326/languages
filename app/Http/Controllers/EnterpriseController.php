<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enterprise;
class EnterpriseController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.enterprise');
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
        $this->validate($request, [
        'first_name'            => 'required|string|max:255',
        'last_name'             => 'required|string|max:255',
        'organization_name'     => 'required|string|max:255',
        'email'                 => 'email',
        'phone_number'          => 'int|required',
    ]);

       $enterprise = new Enterprise();
       $enterprise->first_name = $request->first_name;
       $enterprise->last_name = $request->last_name;
       $enterprise->organization_name = $request->organization_name;
       $enterprise->email = $request->email;
       $enterprise->phone_number = $request->phone_number;
       $enterprise->save();
       return view('user.enterprise') ->with('success', 'Conference record created successfully.');
      
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
