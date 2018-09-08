<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\comentario;

class CommentsController extends Controller
{
    public function store(Request $req){
        $validate = $this->validate($req, [
            'body'=>'required'
        ]);
        $comment = new comentario();
        $user = \Auth::user();
        $comment->user_id = $user->id;
        $comment->video_id = $req->input('video_id');
        $comment->body = $req->input('body');
        $comment->save();
        return redirect()->route('detailVideo', ['videoId'=>$comment->video_id])->with(array(
            'message'=>'Comentario añadido correctamente'
        ));
    }

    public function delete($comment_id){
        $user = \Auth::user();
        $comment = comentario::find($comment_id);

        if($user && ($comment->user_id == $user->id) || $comment->video->user_id == $user->id){
            $comment->delete();
        }
        return redirect()->route('detailVideo', ['videoId'=>$comment->video_id])->with(array(
            'message'=>'Comentario eliminado correctamente'
        ));

    }


}
