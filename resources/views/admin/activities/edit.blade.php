@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.activity.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.activities.update", [$activity->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.activity.fields.name') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($activity) ? $activity->title : '') }}">
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
                <label for="image">{{ trans('global.activity.fields.image') }}</label>
                <div class="img-preview" style="width:300px; height:300px;">
                    @if( isset($destination->thubnails) )
                        <img id="ImdID" class="img-thumbnail" src="{{ url('/storage/images/'.$destination->thumbnails) }}" alt="Image" />
                    @else
                        <img id="ImdID" class="img-thumbnail" src="{{ url('images/placeholder.png') }}" alt="Image" />
                    @endif
                </div>
                <input type="file" id="image" name="image" class="form-control" onchange="readURL(this);">
                @if($errors->has('image'))
                    <em class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                <input type="hidden" class="custom-control-input" id="" name="is_active" value="0">    
                @if( $activity->is_active == 1 )
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