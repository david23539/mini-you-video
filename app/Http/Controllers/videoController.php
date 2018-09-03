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

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
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
        $image = $req->file('image');
        if($image){
            $image_path = time().$image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }
        $video_file = $req->file('video');
        if($video_file){
            $video_path = time().$video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        }
        $video->save();
        return redirect()->route('home')->with(array(
            'mesage'=>'El video se ha subido correctamente'
        ));
    }

}
