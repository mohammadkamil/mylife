<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{

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
        $post=Posts::with('comment','like')->orderBy('created_at', 'desc')->get()->toArray();
        // $likes = $this->user->posts()->get(['id', 'post', 'user_id','liked']);
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
                'post_id'     => 'required',

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

        if($request->type==1){
            $like           = new Like();
            $like->user_id     = $this->user->id;
            $like->post_id     = $request->post_id;
            if ($like->save()) {
                $post=Posts::find($request->post_id);
                $postlike=$post->liked;
                $post->liked=$postlike+1;
                $post->save();
                return response()->json(
                    [
                        'status' => true,
                        'like'   => $like,
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status'  => false,
                        'message' => 'Oops, the like could not be saved.',
                    ]
                );
            }
        }else{
            $like=Like::where("user_id","=",$this->user->id)->where("post_id","=",$request->post_id)->get();
            // return response()->json(
            //     [
            //         'status'  => $like[0]->id,
            //         'message' => 'Oops, the like could not be saved.',
            //     ]
            // );
            // dd($like);
            $likesdelete=Like::find($like[0]->id);


            if ($likesdelete->delete()) {
                $post=Posts::find($request->post_id);
                $postlike=$post->liked;
                $post->liked=$postlike-1;
                $post->save();
                return response()->json(
                    [
                        'status' => true,
                        // 'like'   => $like,
                    ]
                );
            } else {
                return response()->json(
                    [
                        'status'  => false,
                        'message' => 'Oops, the like could not be saved.',
                    ]
                );
            }
        }




    }//end store()


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\like $like
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $posts=Lik::with('comment','like')->find($id);
        // // dd($posts);

        // return $posts;

    }//end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\like         $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {


    }//end update()


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\like $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        if ($like->delete()) {
            return response()->json(
                [
                    'status' => true,
                    'like'   => $like,
                ]
            );
        } else {
            return response()->json(
                [
                    'status'  => false,
                    'message' => 'Oops, the like could not be deleted.',
                ]
            );
        }

    }//end destroy()


    protected function guard()
    {
        return Auth::guard();

    }//end guard()
}
