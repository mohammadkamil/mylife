<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view("index");
        if(isset($_COOKIE['jwt'])){
            // echo "DSDSA";
            return view("index");


        }
        else{
            return redirect()->route('login');

        }
    }
    public function login(Request $request)
    {
        $cookie=Cookie::get('jwt');
        // dd($_COOKIE['jwt']);

        if(isset($_COOKIE['jwt'])){
            return redirect()->route('index');
            // echo "DSDSA";

        }
        else{
            return view("login");

        }
        // return view("login");

    }//end login()


    public function register(Request $request)
    {
        $cookie=Cookie::get('jwt');
        if(isset($_COOKIE['jwt'])){
            // echo "DSDSA";
            return redirect()->route('index');

        }
        else{
            return view("register");

        }


    }//end register()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
