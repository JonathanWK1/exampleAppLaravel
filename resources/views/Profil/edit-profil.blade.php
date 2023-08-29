@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem;">
        <form action="/profil/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="d-flex" style="flex-direction: column">
                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="text" 
                        name="title" 
                        class="form-control  @error('title') is-invalid @enderror"
                        value="{{ old('title') ?? $user->profil->title }}"
                        required autocomplete="title" autofocus
                        id="title">
    
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="text" 
                        name="description" 
                        class="form-control  @error('description') is-invalid @enderror"
                        value="{{ old('description') ?? $user->profil->description }}"
                        required autocomplete="description" autofocus
                        id="description">
    
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="link" class="col-md-4 col-form-label text-md-end">{{ __('Link') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="text" 
                        name="link" 
                        class="form-control  @error('link') is-invalid @enderror"
                        value="{{ old('link') ?? $user->profil->link }}"
                        required autocomplete="link" autofocus
                        id="link">
    
                        @error('link')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Profil Picture') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="file" 
                        name="image" 
                        class="form-control  @error('image') is-invalid @enderror"
                        id="link">
    
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <button class="btn btn-primary" type="submit">
                        Submit
                    </button>
                </div>

            </div>

        </form>
    </div>
</div>
@endsection
