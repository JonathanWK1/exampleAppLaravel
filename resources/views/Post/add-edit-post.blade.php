@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding:1rem;">
        <form action={{ $post == null ? "/post" : "/post/$post->id" }} method="post" enctype="multipart/form-data">
            @csrf
            @if($post != null)
                @method("PATCH")
            @endif
            <div class="d-flex" style="flex-direction: column">
                <div class="row mb-3">
                    <label for="caption" class="col-md-4 col-form-label text-md-end">{{ __('Caption') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="text" 
                        name="caption" 
                        class="form-control  @error('caption') is-invalid @enderror"
                        value="{{ old('caption') ?? $post->caption ?? "" }}"
                        required autocomplete="caption" autofocus
                        id="caption">
    
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Post Picture') }}</label>
    
                    <div class="col-md-4">
    
                        <input type="file" 
                        name="image" 
                        class="form-control  @error('image') is-invalid @enderror"
                        id="image">
    
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
