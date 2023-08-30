@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem; background-color:antiquewhite">
        <div class="col-md-3">
            <img class="rounded-circle" style="aspect-ratio:1; width:80%" src="{{ $user->imagePath() }}" alt="sad">
        </div>
        <div class="col-md-9">
            <div class=" d-flex justify-content-between ">
                <div>
                    <h4>{{ $user->name }}</h4>
                </div>
                @can('follow',$user)
                    <div>
                        <follow-button user-id="{{ $user->id }}" follow="{{ Auth::user()->isFollowing($user) }}">
                            
                        </follow-button>
                    </div>
                @endcan
            </div>
            
            <div class="d-flex">
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">{{ $user->posts->count() }}</span>
                    <span style="text-align: center">Post</span>
                </div>
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">{{ $user->followers->count() }}</span>
                    <span style="text-align: center">Followers</span>
                </div>
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">{{ $user->following->count() }}</span>
                    <span style="text-align: center">Following</span>
                </div>

            </div>
            <div class="d-flex" style="padding-bottom:1rem; flex-direction:column">
                <span>{{ $user->profil->title}}</span>
                <span>{{ $user->profil->description}}</span>
                <span>{{ $user->profil->link}}</span>
            </div>

        </div>
    </div>
    <div class="row d-flex flex-row pt-4 " >

        @foreach ($user->posts as $post)
        <div class="p-2 col-lg-4" style="background-color: rgb(217, 217, 217); border: 1px solid black">
            <a href="/post/{{ $post->id }}">
                <div class="d-flex align-items-center " style="flex-direction: column;">
                    <img src="{{ $post->imagePath() }}" alt="" style="aspect-ratio:1;width:100%">
                    <span style="color:black; align-self:center; width:100%;text-align:center">
                        {{ $post->caption }}
                    </span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
