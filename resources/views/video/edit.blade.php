@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Editar el video</h2>
            <hr>
            <form action="{{route('updateVideo',['video_id' =>$video->id])}}" method="POST" enctype="multipart/form-data" class="col-lg-7">
                {!! csrf_field() !!}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>

                @endif
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{$video->title}}">
                </div>

                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <textarea name="description" id="description" class="form-control">{{$video->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Miniatura</label>
                    @if (\Storage::disk('images')->has($video->image))
                        <div class="video-image-thumb ">
                            <div class="video-image-mask">
                                <img src="{{url('miniatura/'.$video->image)}}" class="video-image">
                            </div>
                        </div>
                    @endif
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="video">Video</label>
                    <video controls id="video-player">
                        <source src="{{route('fileVideo',['filename' => $video->video_path])}}"></source>

                        tu navegador no es compatible
                    </video>
                    <input type="file" name="video" class="form-control" id="video">
                </div>

                <button type="submit" class="btn btn-warning">Modificar Video</button>
            </form>
        </div>
    </div>
@endsection