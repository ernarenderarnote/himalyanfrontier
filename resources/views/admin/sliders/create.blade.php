@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Sliders
    </div>

    <div class="card-body">
        <form action="{{ route("admin.slides.store") }}" method="POST" enctype="multipart/form-data">
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
            <div class="card">
                <div class="card-header">
                    Gallery Images
                </div>
                <div class="card-body">
                    <div class="preview-images-zone">
                    
                    </div>
                    <fieldset class="form-group">
                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                        <input type="file" id="pro-image" name="photo[]" style="display: none;" class="form-control" multiple>
                    </fieldset>
                    @if($errors->has('photo'))
                        <em class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </em>
                    @endif
                </div>        
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
