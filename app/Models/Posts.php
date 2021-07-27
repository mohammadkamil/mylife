<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Posts extends Model
{
    use HasFactory;
    public function comment()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id')->orderBy('created_at', 'desc');

    }//e
    public function like()
    {
        return $this->hasMany(Like::class, 'post_id','id' )->where("user_id","=",Auth::guard()->user()->id);

    }//e
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');

    }//end todos()
}
