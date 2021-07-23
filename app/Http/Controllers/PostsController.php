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
        $this->middleware('auth:api',['except' => ['index','show']]);
        $this->user = $this->guard()->user();

    }//end __construct()


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->user->posts->get(['id', 'post', 'user_id','liked']);
        return response()->json($todos->toArray());

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
                    'todo'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the todo could not be saved.',
                ]
            );
        }

    }//end store()


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        return $posts;

    }//end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Todo         $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
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

        $posts->post     = $request->post;

        if ($posts->save()) {
            return response()->json(
                [
                    'status' => true,
                    'todo'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the todo could not be updated.',
                ]
            );
        }

    }//end update()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        if ($posts->delete()) {
            return response()->json(
                [
                    'status' => true,
                    'todo'   => $posts,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the todo could not be deleted.',
                ]
            );
        }

    }//end destroy()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()
}
