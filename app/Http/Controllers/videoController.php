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

    public function getVideos($filename){
        $file = Storage::disk('videos')->get($filename);
        return new Response($file, 200);
    }

    public function saveVideo(Request $req)
    {
        $validateData = $this->validate($req, [
            'title' => 'required |min:5',
            'description' => 'required',
            'video' => 'mimes:mp4'
        ]);
        $video = new video();
        $user = \Auth::user();
        $video->user_id = $user->id;
        $video->title = $req->input('title');
        $video->description = $req->input('description');
        $image = $req->file('image');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }
        $video_file = $req->file('video');
        if ($video_file) {
            $video_path = time() . $video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        }
        $video->save();
        return redirect()->route('home')->with(array(
            'mesage' => 'El video se ha subido correctamente'
        ));
    }

    public function getVideoPage($video_id){
        
        
        $video = video::find($video_id);
        return view('video.detail', array(
            'video'=>$video
        ));

    }

    public function delete($video_id){
        $user = \Auth::user();
        $video = video::find($video_id);
        $comment = comentario::where('video_id',$video_id)->get();
        if($user && $video->user_id == $user->id){
            if($comment && count($comment)>=1){
                foreach ($comment as $com)
                    $com->delete();
            }
       Storage::disk('images')->delete($video->image);
            Storage::disk('videos')->delete($video->video_path);

            $video->delete();
            $mesage =array('mesage'=>'Video eliminado correctamente');
        }else{
            $mesage =array('mesage'=>'El video no se ha eliminado');
        }
        return redirect()->route('home')->with($mesage);
    }

    public function edit($video_id){

        $video = video::findOrFail($video_id);
        $user = \Auth::user();
        if($user && $video->user_id == $user->id){
            return view('video.edit', array(
                'video'=>$video
            ));
        }else{
            return redirect()->route('home');

        }

    }

    public function update($video_id, Request $req){
        $validate = $this->validate($req, array(
            'title' => 'required |min:5',
            'description' => 'required',
            'video' => 'mimes:mp4'
        ));
        $user = \Auth::user();
        $video = video::findOrFail($video_id);
        $video->user_id = $user->id;
        $video->title = $req->input('title');
        $video->description = $req->input('description');
        $image = $req->file('image');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images')->put($image_path, \File::get($image));
            $video->image = $image_path;
        }
        $video_file = $req->file('video');
        if ($video_file) {
            $video_path = time() . $video_file->getClientOriginalName();
            \Storage::disk('videos')->put($video_path, \File::get($video_file));
            $video->video_path = $video_path;
        }
        $video->update();
        return redirect()->route('home')->with(array(
            'mesage' => 'El video se ha modificado correctamente'
        ));
    }

    public function search($search = null){
        if(is_null($search)){
            $search = \Request::get('search');
        }
        $video = video::where('title','LIKE','%'.$search.'%')->paginate(5);

        return view('video.search',array(
            'videos'=>$video,
            'search'=>$search
        ));
    }


}
