@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.blogs.update", [$blog->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.blog.fields.name') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($blog) ? $blog->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>   
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('global.blog.fields.description') }}</label>
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea id="description" name="description" class="form-control summernote">{{ old('description', isset($blog) ? $blog->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('thumbnails') ? 'has-error' : '' }}">
                <label for="image">{{ trans('global.blog.fields.image') }}</label>
                <div class="img-preview" style="width:300px; height:300px;">
                    @if( isset($blog->thumbnails) )
                        <img id="ImdID" class="img-thumbnail" src="{{ url('/storage/images/blogs/featureImages/'.$blog->thumbnails) }}" alt="Image" />
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
            <!--Gallery Images-->
            <div class="card">
                <div class="card-header">
                    Gallery Images
                </div>
                <div class="card-body">
                    <div class="preview-images-zone">
                        @if( isset($blog->gallery_img ) )
                            @foreach(json_decode($blog->gallery_img) as $key=>$gallery)
                                <div class="preview-image preview-show-{{$key}}">
                                    <input type="hidden" name="gallery_upload_img[]" value="{{ $gallery }}">
                                    <div class="image-cancel" data-no="{{$key}}">x</div>
                                    <div class="image-zone"><img id="pro-img-{{$key}}" src="{{ url('/storage/images/blogs/galleryImages/'.$gallery) }}"></div>
                               </div>
                            @endforeach
                        @endif
                    </div>
                    <fieldset class="form-group">
                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                        <input type="file" id="pro-image" value="{{$blog->gallery_img}}" name="gallery_img[]" style="display:none;" class="form-control" multiple>
                    </fieldset>
                </div>        
            </div>
            <!--Gallery Images End -->
            <div class="form-group">
                <div class="custom-control custom-switch">
                <input type="hidden" class="custom-control-input" id="" name="is_active" value="0">    
                @if( $blog->is_active == 1 )
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