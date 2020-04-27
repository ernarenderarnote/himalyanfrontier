@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.activity.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.activities.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.activity.fields.title') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($activity) ? $activity->name : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.activity.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.activity.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control summernote">{{ old('description', isset($activity) ? $activity->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.activity.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.activity.fields.image') }}</label>
                <div class="img-preview" style="width:300px; height:300px;">
                    <img id="ImdID" class="img-thumbnail" src="{{ url('images/placeholder.png') }}" alt="Image" /><br/>
                </div>
                <input type="file" id="image" name="image" class="form-control" onchange="readURL(this);">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </em>
                @endif
            </div>
            <!--Gallery Images-->
            <div class="card">
                <div class="card-header">
                    Gallery Images
                </div>
                <div class="card-body">
                    <div class="preview-images-zone">
                    
                    </div>
                    <fieldset class="form-group">
                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                        <input type="file" id="pro-image" name="gallery_img[]" style="display: none;" class="form-control" multiple>
                    </fieldset>
                </div>        
            </div>
            <!--Gallery Images End -->
            <div class="form-group">
                <label for="status">Activity Position</label>
                <input type="number" min="0" class="form-control" value="" name="position">
            </div> 
            <div class="form-group">
                <div class="custom-control custom-switch">
                <input type="hidden" class="custom-control-input" id="" name="is_active" value="0">    
                <input type="checkbox" class="custom-control-input" id="switch1" name="is_active" value="1">
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