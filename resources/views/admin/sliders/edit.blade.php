@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Sliders
    </div>

    <div class="card-body">
        <form action="{{ route("admin.slides.update", [$slider->id] ) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($slider) ? $slider->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
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
                        @if( isset($slider->photo ) )
                            @foreach(json_decode($slider->photo ) as $key=>$slides)
                                <div class="preview-image preview-show-{{$key}}">
                                    <input type="hidden" name="gallery_upload_img[]" value="{{ $slides }}">
                                    <div class="image-cancel" data-no="{{$key}}">x</div>
                                    <div class="image-zone"><img id="pro-img-{{$key}}" src="{{ url('/storage/images/sliders/'.$slides) }}"></div>
                               </div>
                            @endforeach
                        @endif
                    </div>
                    <fieldset class="form-group">
                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                        <input type="file" id="pro-image" value="{{ $slider->photo }}" name="photo[]" style="display:none;" class="form-control" multiple>
                    </fieldset>
                </div>        
            </div>
            <!--Gallery Images End -->
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
