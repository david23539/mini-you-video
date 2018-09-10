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
            @include('video.videosList')
            <div class="clearfix">
                {{$videos->links()}}
            </div>
        </div>
    </div>
</div>
@endsection
