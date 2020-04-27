@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Update Video
    </div>

    <div class="card-body">
        <form action="{{ route("admin.youtube-slider.update", [$youtubeSlider->id] ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($youtubeSlider) ? $youtubeSlider->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="thumbnail-url">Thumbnail Url</label>
                <input type="text" id="thumbnail-url" name="thumbnail_url" class="form-control" value="{{ old('thumbnail_url', isset($youtubeSlider) ? $youtubeSlider->thumbnail_url : '') }}">
                @if($errors->has('thumbnail_url'))
                    <em class="invalid-feedback">
                        {{ $errors->first('thumbnail_url') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="youtube-url">Youtube Url</label>
                <input type="text" id="youtube-url" name="youtube_url" class="form-control" value="{{ old('youtube_url', isset($youtubeSlider) ? $youtubeSlider->youtube_url : '') }}">
                @if($errors->has('youtube_url'))
                    <em class="invalid-feedback">
                        {{ $errors->first('youtube_url') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="status">Position</label>
                <input type="number" min="0" class="form-control" value="{{ $youtubeSlider->position }}" name="position">
            </div> 
            <div class="form-group">
                <div class="custom-control custom-switch">
                <input type="hidden" class="custom-control-input" id="" name="is_active" value="0">    
                @if( $youtubeSlider->is_active == 1 )
                    <input type="checkbox" class="custom-control-input" id="switch1" name="is_active" value="1" checked>
                @else
                    <input type="checkbox" class="custom-control-input" id="switch1" name="is_active" value="1">
                @endif
                    <label class="custom-control-label" for="switch1">Active</label>
                </div>
            </div> 
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
