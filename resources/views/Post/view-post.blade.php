@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem; background-color:aliceblue">
        <div class="col-lg-6">
            <img src="/storage/{{ $post->image }}" alt="" style="width:100%; aspect-ratio:1">
        </div>
        <div class="col-lg-6">
            <div class="row">
                
            </div>
            <div class="row">
                <div>
                    <div class="d-flex justify-content-between p-2 rounded-2 " style="background-color:rgb(255, 193, 142)">
                        <a href="/profil/{{ $post->user->id }}">
                            <div class="d-flex">
                                <img src="{{ $post->user->imagePath() }}" alt="" class=" rounded-circle " style="width:80px">
                                <span class=" p-4 ">
                                    {{ $post->user->name }}
                                </span>
                            </div>
                        </a>
                        @can('follow',$post->user)
                        <div style="align-self: center">
                            <follow-button user-id="{{ $post->user->id }}" follow="{{ Auth::user()->isFollowing($post->user) }}">
                            
                            </follow-button>    
                        </div>
                        @endcan
                    </div>
                    
                </div>
                <div class="row pt-4">
                    @auth
                        <like-button post-id="{{ $post->id }}" like="{{ Auth::user()->isLiked($post) }}">
    
                        </like-button>
                    @endauth
                    <div>
                        {{ $post->likedBy->count() }} likes
                    </div>
                </div>
                <div style="">
                    @can('update',$post)
                    <a href="/post/{{ $post->id }}/edit" class="btn btn-primary text-white ">Edit post</a>
                    @endcan
                </div>
            </div>
            <div class="row h-100 ">
                <span>{{ $post->caption }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
