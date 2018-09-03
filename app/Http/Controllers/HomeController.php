<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\video;

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
//        $videos = DB::table('videos')->paginate(5);
        $videos = video::orderBy('title','asc')->paginate(5);
        return view('home', array(
            'videos'=>$videos
        ));
    }
}
