<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
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
        $post=Posts::with('comment','like')->orderBy('updated_at', 'desc')->cursorPaginate(5);
        // $post=Posts::with('comment','like')->orderBy('updated_at', 'desc')->get()->toArray();
        // $posts = $this->user->posts()->get(['id', 'post', 'user_id','liked']);
        return response()->json(
            [
                'post' => $post,
                'user' => $this->user,
            ]);

    }//end index()


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
                'post'     => 'required|string',

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

        $posts           = new Posts();
        $posts->post     = $request->post;
        $posts->user_id     = $this->user->id;
        $posts->liked     = 0;

        if ($posts->save()) {
            return response()->json(
                [
                    'status' => true,
                    'post'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the post could not be saved.',
                ]
            );
        }

    }//end store()


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts=Posts::with('comment','like','user')->find($id);
        // dd($posts);

        return $posts;

    }//end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\post         $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'posts'     => 'required|string',

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
        $posts=Posts::find($request->id);
        $posts->post     = $request->posts;

        if ($posts->save()) {
            return response()->json(
                [
                    'status' => true,
                    'post'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the post could not be updated.',
                ]
            );
        }

    }//end update()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $posts=Posts::find($request->id);
        if ($posts->delete()) {
            return response()->json(
                [
                    'status' => true,
                    'post'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the post could not be deleted.',
                ]
            );
        }

    }//end destroy()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()
}
