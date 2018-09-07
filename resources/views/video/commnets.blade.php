<hr>
<h4>Comentarios</h4>
<hr>
@if(session('message'))
                <div class="aler alert-success">
                    {{session('message')}}
                </div>
            @endif
<form class="col-md-4" method="POST" action="{{url('/comments')}}">
    {!! csrf_field()!!}
    
<input type="hidden" name="video_id" value="{{$video->id}}" required/>
<p>
    <textarea class="form-control" name="body" required></textarea>
</p>
<input type="submit" value="comentario" class="btn btn-success"/>
</form>