@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.destination.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.destinations.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.destination.fields.title') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($destination) ? $destination->name : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.destination.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.destination.fields.description') }}</label>
                <textarea id="description" name="description" class="form-control summernote">{{ old('description', isset($destination) ? $destination->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.destination.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.destination.fields.image') }}</label><br/>
                <img id="ImdID" class="img-thumbnail" src="{{ url('images/placeholder.png') }}" alt="Image" />
                <input type="file" id="image" name="image" class="form-control" onchange="readURL(this);">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </em>
                @endif
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