<?php

namespace App\Http\Controllers;

use App\Discussions;
use App\UserVoteDiscussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Facade\FlareClient\View;

class DiscussionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('discussions')->leftJoin('users', 'users.id', '=', 'discussions.user_id');

        if (isset($_GET['search'])) {
            $posts->where('heading', 'like', '%' . $_GET['search'] . '%');
        }
        if (isset($_GET['sort'])) {
            $posts = $posts->sortBY($_GET['sort']);
        }
        $posts = $posts->select('users.avatar', 'users.name', 'discussions.*')->paginate(10);
        $voted_by_user = DB::table('user_vote_discussion')->where('user_id', Auth::id())->get();
        $languages = DB::table('languages')->select('name')->inRandomOrder()->limit(10)->get();
        $view = View("discussions.partial",compact('posts'));
        return view('discussions.discussions')->with(['posts' => $posts, 'languages' => $languages,'html'=>$view]);
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
        $request->validate([
            'language' => 'required',
            'title' => 'required|string|max:254',
            'discussionbody' => 'required',
            'disscussionImage' => 'required|mimes:jpeg,jpg,png,svg|max:2048'
        ]);

        if ($request->hasFile('disscussionImage')) {
            if ($request->file('disscussionImage')->isValid()) {
                $File = $request->file('disscussionImage');
                $file_path =  $request->file('disscussionImage')->storeAs('/disscussion/', time() . '.' . $File->getClientOriginalExtension());

                DB::table('discussions')->insert([
                    'user_id' => Auth::id(),
                    'language_id' => $request->language,
                    'heading' => $request->title,
                    'body' => $request->discussionbody,
                    'media_link' => $file_path
                ]);
                return redirect()->back()->withErrors(['success' => 'Discussion has been added successfully']);
            }else{
                return redirect()->back();
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
    { }

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
    public function newdiscussion(Request $request)
    {
        dd('hello');
        exit;
    }

    //vote discussion
    public function vote(Request $request)
    {
        // if(isset($_GET['vote'])){
        // $vote = $_GET['vote'];
        $vote = $request->vote;
        $userid = Auth::id();
        $discussionid = $request->id;
        // $discussionid = 1;
       $check = UserVoteDiscussion::where("user_id",$userid)->where("discussion_id",$discussionid)->first();
    //    dd($vote);
       if($check == null){
           $discussion = new UserVoteDiscussion;
           $discussion->user_id = $userid;
           $discussion->discussion_id = $discussionid;
           $discussion->vote = $vote;
           $discussion->save();
           if($vote == '1'){
               $diss = Discussions::find($discussionid);
               $diss->upvote = $diss->upvote + 1;
               $diss->update();
           }else if($vote == '-1'){
            $diss = Discussions::find($discussionid);
            $diss->downvote = $diss->downvote + 1;
            $diss->update();
           }
        }else{
            if($vote == '1' && $check->vote != '1'){
                $diss = Discussions::find($discussionid);
                $diss->upvote = $diss->upvote + 1;
                $diss->downvote = $diss->downvote - 1;
                $diss->update();
                $check->vote = $vote;
                $check->update();
            }else if($vote == '-1' && $check->vote != '-1'){
                $diss = Discussions::find($discussionid);
                $diss->downvote = $diss->downvote + 1;
                $diss->upvote = $diss->upvote - 1;
                $diss->update();
                $check->vote = $vote;
                $check->update();
            }
        }
    }

    //sort discussion by trending,new and myposts
    public function sortBy(Request $request)
    {
        $sortby = $request->sort;
        $discussion = [];
        if ($request->ajax()) {
            if ($sortby == 'myposts') {
                $discussion = DB::table('discussions')->where('discussions.user_id', Auth::id());
            } else
            if ($sortby == 'trending') {
                $discussion = DB::table('discussions')->select('*')->orderby(DB::raw('abs(upvote-downvote)'), 'desc');
            } elseif ($sortby == 'new') {
                $discussion = DB::table('discussions')->orderBy('discussions.created_at', 'desc');
            }
            $posts = $discussion->leftJoin('users', 'users.id', '=', 'discussions.user_id')->limit(20)->get();
            return response()->view("discussions.partial",compact('posts'));
        } else {
            $languages = DB::table('languages')->select('name')->inRandomOrder()->limit(10)->get();
            return view('discussions.discussions')->with(['posts' => $discussion, 'languages' => $languages]);
        }
    }
}
