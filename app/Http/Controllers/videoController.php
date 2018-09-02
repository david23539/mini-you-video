<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\video;
use App\comentario;

class videoController extends Controller
{
    public function createVideo(){
        return view('video.createVideo');
    }

    public function saveVideo(Request $req){
        $validateData = $this->validate($req, [
            'title'=> 'required |min:5',
            'description' => 'required',
            'video'=>'mimes:mp4'
        ]);
        $video = new video();
        $user = \Auth::user();
        $video->user_id = $user->id;
        $video->title = $req->input('title');
        $video->description = $req->input('description');

        $video->save();
        return redirect()->route('home')->with(array(
            'mesage'=>'El video se ha subido correctamente'
        ));
    }

}
