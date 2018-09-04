@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('mesage'))
                <div class="aler alert-success">
                    {{session('mesage')}}
                </div>
            @endif
            <div id="videosList">
                @foreach($videos as $video)
                    <div class="video-item col-lg-10 pull-left panel panel-default">
                        <div class="panel-body col-lg-3">
                            @if (\Storage::disk('images')->has($video->image))
                                <div class="video-image-thumb col-md-3 pull-left">
                                    <div class="video-image-mask">
                                        <img src="{{url('miniatura/'.$video->image)}}" class="video-image">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="data">
                            <h4 class="video-title">
                                <a href="{{ route('detailVideo', ['videoId'=>$video->id])}}"> {{$video->title}}</a>
                            </h4>
                            <p>
                                {{$video->user->name. ' '.$video->user->surname}}
                            </p>
                        </div>
                        <a href="" class="btn btn-success">Ver</a>
                        @if (Auth::check() && Auth::user()->id == $video->user->id)
                            <a href="" class="btn btn-warning">Editar</a>
                            <a href="" class="btn btn-danger">Eliminar</a>
                        @endif
                    </div>
                @endforeach
            </div>
            {{$videos->links()}}
        </div>
    </div>
</div>
@endsection
