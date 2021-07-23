<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComentsController extends Controller
{
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
        $todos = $this->user->coments->get(['id', 'coment', 'user_id']);
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

        $coments           = new Coments();
        $coments->post     = $request->coment;
        $coments->user_id     = $this->user->id;


        if ($coments->save()) {
            return response()->json(
                [
                    'status' => true,
                    'todo'   => $coments,
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
    public function show(Coments $coments)
    {
        return $coments;

    }//end show()


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Todo         $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coments $coments)
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

        $coments->coment     = $request->coment;

        if ($coments->save()) {
            return response()->json(
                [
                    'status' => true,
                    'todo'   => $coments,
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
    public function destroy(Coments $coments)
    {
        if ($coments->delete()) {
            return response()->json(
                [
                    'status' => true,
                    'todo'   => $coments,
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
