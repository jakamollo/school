<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function homepage(){
        $user_school = Auth::user()->school;
        $posts = Post::where('school_id', $user_school->id)->orderBy('created_at', 'desc')->paginate(4);
        return view('home.home', ['user' => Auth::user(), 'posts' => $posts]);
    }
}
