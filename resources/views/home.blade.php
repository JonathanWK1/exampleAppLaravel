@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex flex-column gap-4 ">
            @foreach ( $posts as $post )
                <div class="card p-4 ">
                    <div class="card-header">
                        <div class="d-flex justify-content-between ">
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

                    <div class="card-body">
                        <div class=" d-flex flex-column ">
                            <a href="/post/{{ $post->id }}">
                                <img src="{{ $post->imagePath() }}" alt="" style="width: 100%; aspect-ratio:1;">
                            </a>
                            <div class="row pt-4">
                                @auth
                                    <like-button post-id="{{ $post->id }}" like="{{ Auth::user()->isLiked($post) }}">
                
                                    </like-button>
                                @endauth
                                <div>
                                    {{ $post->likedBy->count() }} likes
                                </div>
                            </div>
                            <span style="width: 100%;" >
                                {{ $post->caption }}
                            </span>
                        </div>
                    </div>
                </div>                
            @endforeach
        </div>
    </div>
</div>
@endsection
