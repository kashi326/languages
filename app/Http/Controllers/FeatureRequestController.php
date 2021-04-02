<?php

namespace App\Http\Controllers;

use App\FeatureRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeatureRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(isset($_GET['status']) && $request->ajax()){
            $status = $_GET['status'];
            $features = FeatureRequest::where('status',$status)->get();
            return response()->view('featurerequest.list',compact('features'));
        }
        $features = FeatureRequest::get();
        $view = view('featurerequest.list',compact('features'));
        return view('featurerequest.index',compact(['view','features']));
    }
    public function adminindex(){
        $features = FeatureRequest::paginate(15);
        return view('admin.featurerequest.index')->with('features',$features);
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
            'title' => "required|min: 10|max: 190",
            'Information' => "required|min: 10",
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()], 401);
        }
        $feature = new FeatureRequest;
        $feature->title = strip_tags($request->title);
        $feature->information = strip_tags($request->Information);
        $feature->save();
        return response()->json(['message' => 'Your Request Has been Submitted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FeatureRequest  $featureRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature = FeatureRequest::find($id);
        return view('admin.featurerequest.details',compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FeatureRequest  $featureRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(FeatureRequest $featureRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FeatureRequest  $featureRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $featureRequest = FeatureRequest::find($id);
        $featureRequest->status = $request->status;
        $featureRequest->update();
        return response()->json(['message'=>'Status updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FeatureRequest  $featureRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeatureRequest $featureRequest)
    {
        //
    }
    public function vote(Request $request){
        $feature = FeatureRequest::find($request->ID);
        $feature->votes = $feature->votes + 1;
        $feature->update();
        return response()->json(['message'=>'Voteed']);
    }
}
