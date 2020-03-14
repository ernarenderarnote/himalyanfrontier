@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Sliders
    </div>

    <div class="card-body">
        <form action="{{ route("admin.youtube-slider.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($slider) ? $slider->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="thumbnail-url">Thumbnail Url</label>
                <input type="text" id="thumbnail-url" name="thumbnail_url" class="form-control" value="{{ old('thumbnail_url', isset($slider) ? $slider->thumbnail_url : '') }}">
                @if($errors->has('thumbnail_url'))
                    <em class="invalid-feedback">
                        {{ $errors->first('thumbnail_url') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="youtube-url">Youtube Url</label>
                <input type="text" id="youtube-url" name="youtube_url" class="form-control" value="{{ old('youtube_url', isset($slider) ? $slider->youtube_url : '') }}">
                @if($errors->has('youtube_url'))
                    <em class="invalid-feedback">
                        {{ $errors->first('youtube_url') }}
                    </em>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
