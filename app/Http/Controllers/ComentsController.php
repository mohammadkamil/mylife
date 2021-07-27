<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComentsController extends Controller
{
    protected $user;


    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = $this->guard()->user();

    }//end __construct()


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment=Comments::orderBy('created_at', 'desc')->cursorPaginate(1);
        // $comments = $this->user->posts()->get(['id', 'post', 'user_id','liked']);
        return response()->json(
            [
                'comment' => $comment,
                'user' => $this->user,
            ]);

    }//end index()

    public function commentbyid(Request $request)
    {
        $comment=Comments::with('post')->where("post_id","=",$request->post_id)->orderBy('created_at', 'desc')->cursorPaginate(1);
        $post=Posts::find($request->post_id);     // $comments = $this->user->posts()->get(['id', 'post', 'user_id','liked']);
        return response()->json(
            [
                'comment' => $comment,
                'user' => $this->user,
                'post'=>$post
            ]);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'comment'     => 'required|string',

            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                400
            );
        }

        $comment           = new Comments();
        $comment->coment=$request->comment;
        $comment->post_id     = $request->post_id;
        $comment->user_id     = $this->user->id;

        if ($comment->save()) {
            $post=Posts::find($request->post_id);
            $post->updated_at = date('Y-m-d G:i:s');
            $post->save();
            return response()->json(
                [
                    'status' => true,
                    'comment'   => $comment,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the comment could not be saved.',
                ]
            );
        }

    }//end store()


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Comments::find($id);
        // dd($posts);

        return $posts;

    }//end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\comment         $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comments $comment)
    {

    }//end update()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comments $comment)
    {
        if ($comment->delete()) {
            return response()->json(
                [
                    'status' => true,
                    'comment'   => $comment,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the comment could not be deleted.',
                ]
            );
        }

    }//end destroy()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()
}
