@extends('layouts.app')

@section('content')
    <div class="col-md-11 col-md-offset-1">
        <h2>{{$video->title}}</h2>
        <hr>
        <div class="col-md-8">
            <video controls id="video-player">
            <source src="{{route('fileVideo',['filename' => $video->video_path])}}"></source>
            
                tu navegador no es compatible
            </video>
            <div class="panel panel-default video-data">
                <div class="panel-heading">
                    <div class="panel-title">
                    Subido por <strong><a href="{{route('channel',['user_id'=>$video->user_id])}}">{{$video->user->name. ' '.$video->user->surname}}</a><strong>hace
                        {{\FormatTime::LongTimeFilter(new \DateTime())}}
                        
                    </div>
                </div>
                <div class="panel-body">
                    {{$video->description}}
                </div>
            </div>
                @include('video.commnets')


        </div>
    </div>
@endsection
