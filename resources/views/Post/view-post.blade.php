@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem; background-color:aliceblue">
        <div class="col-lg-6">
            <img src="/storage/{{ $post->image }}" alt="" style="width:100%">
        </div>
        <div class="col-lg-6">
            <div class="row">
                
            </div>
            <div class="row">
                <div>
                    <img src="/storage/{{ $post->user->image }}" alt="" class="rounded-circle" style="width: 100px">
                    <span style="padding-left:1rem">
                        {{ $post->user->name }}
                    </span>
                </div>
                <div style="padding:1rem">
                    @can('update',$post)
                    <a href="/post/{{ $post->id }}/edit">edit post</a>
                    @endcan
                </div>
            </div>
            <div class="row" style="padding-top:1rem">
                <span>{{ $post->caption }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
