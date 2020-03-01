@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Add Testimonials
    </div>

    <div class="card-body">
        <form action="{{ route("admin.testimonials.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">Title*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($testimonial) ? $testimonial->name : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif

            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control summernote">{{ old('description', isset($testimonial) ? $testimonial->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="image">Thumbnail</label>
                <div class="img-preview" style="width:300px; height:300px;">
                    
                    <img id="ImdID" class="img-thumbnail" src="{{ url('images/placeholder.png') }}" alt="Image" />
                               
                </div>
                <input type="file" id="image" name="image" class="form-control" onchange="readURL(this);">
    
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