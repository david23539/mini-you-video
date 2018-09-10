<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use App\video;
use App\comentario;
use App\User;

class UserController extends Controller
{
   public function channel($user_id) {
        $user = User::find($user_id);
        $video = video::where('user_id', $user_id)->paginate(5);

        return view('user.channel', array(
            'user'=> $user,
            'videos' =>$videos
        ));

   }
}
