@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem;">
        <div class="col-md-3">
            <img class="rounded-circle" src="/storage/{{ $user->image }}" alt="sad">
        </div>
        <div class="col-md-9">
            <h4>{{ $user->name }}</h4>
            <div class="d-flex">
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">{{ $user->posts->count() }}</span>
                    <span style="text-align: center">post</span>
                </div>
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">12</span>
                    <span style="text-align: center">post</span>
                </div>
                <div class="d-flex" style="flex-direction:column; padding-right:1rem">
                    <span style="text-align: center">12</span>
                    <span style="text-align: center">post</span>
                </div>

            </div>
            <div class="d-flex" style="padding-bottom:1rem; flex-direction:column">
                <span>{{ $user->profil->title}}</span>
                <span>{{ $user->profil->description}}</span>
                <span>{{ $user->profil->link}}</span>
                @can('update',$user->profil)
                    <a href="/profil/{{ $user->id }}/edit">edit profile</a>                
                @endcan
                @can('create', [App\Models\Post::class,$user])
                    <a href="/post">add post</a>                
                @endcan
            </div>

        </div>
    </div>
    <div class="row">
        @foreach ($user->posts as $post)
        <a href="/post/{{ $post->id }}">
            <div class="d-flex col-lg-3" style="flex-direction: column; background-color:rgb(215, 215, 215); padding:5px">
                <img src="/storage/{{ $post->image }}" alt="">
                <span style="color:black; align-self:center">
                    {{ $post->caption }}
                </span>
            </div>
        
        </a>
        @endforeach
    </div>
</div>
@endsection
