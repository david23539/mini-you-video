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
                   <a href="{{route('channel',['user_id'=>$video->user_id])}}">{{$video->user->name. ' '.$video->user->surname}}</a> {{\FormatTime::LongTimeFilter(new \DateTime())}}
                </p>
            </div>
            <a href="{{ route('detailVideo', ['videoId'=>$video->id])}}" class="btn btn-success">Ver</a>
            @if (Auth::check() && Auth::user()->id == $video->user->id)
                <a href="{{ route('videoEdit', ['video_id'=>$video->id])}}" class="btn btn-warning">Editar</a>
                {{--<a href="" class="btn btn-danger">Eliminar</a>--}}

                    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                <a href="#mModal{{$video->id}}" role="button" class="btn btn-large btn-danger" data-toggle="modal">Eliminar</a>

                    <!-- Modal / Ventana / Overlay en HTML -->
                    <div id="mModal{{$video->id}}" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">¿Estás seguro?</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Seguro que quieres borrar el video?</p>
                                    <p class="text-warning"><small>Si lo borras, nunca podrás recuperarlo.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <a  href='{{url('/delete-video',$video->id)}}' type="button" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>
                        </div>
                    </div>

            @endif
        </div>
    @endforeach
</div>