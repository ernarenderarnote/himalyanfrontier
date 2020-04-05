@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Update Testimonials
    </div>

    <div class="card-body">
        <form action="{{ route("admin.testimonials.update", [$testimonial->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">Title*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($testimonial) ? $testimonial->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif

            </div>
            <div class="form-group {{ $errors->has('author') ? 'has-error' : '' }}">
                <label for="description">Author</label>
                <textarea id="description" name="author" class="form-control summernote">{{ old('author', isset($testimonial) ? $testimonial->author : '') }}</textarea>
                @if($errors->has('author'))
                    <em class="invalid-feedback">
                        {{ $errors->first('author') }}
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
                    
                    @if( isset($testimonial->photo) )
                        <img id="ImdID" class="img-thumbnail" src="{{ url('/storage/images/testimonials/'.$testimonial->photo) }}" alt="Image" />
                    @else
                        <img id="ImdID" class="img-thumbnail" src="{{ url('images/placeholder.png') }}" alt="Image" />
                    @endif 
                               
                </div>
                <input type="file" id="image" name="image" class="form-control" onchange="readURL(this);">
    
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                <input type="hidden" class="custom-control-input" id="" name="is_active" value="0">    
                @if( $testimonial->is_active == 1 )
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