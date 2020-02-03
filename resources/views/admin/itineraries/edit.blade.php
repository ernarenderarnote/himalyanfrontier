@extends('layouts.admin')
@section('content')
<form action="{{ route("admin.itineraries.update", [$itinerary->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">

        <div class="col-md-8">
        
            <div class="card">
            
                <div class="card-header">
                    Create Activity
                </div>

                <div class="card-body">
                
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="name">{{ trans('global.itinerary.fields.title') }}*</label>
                        <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($itinerary) ? $itinerary->title : '') }}">
                        @if($errors->has('title'))
                            <em class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.itinerary.fields.name_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('subtitle') ? 'has-error' : '' }}">
                        <label for="name">Sub Title</label>
                        <input type="text" id="subtitle" name="subtitle" class="form-control" value="{{ old('subtitle', isset($itinerary) ? $itinerary->subtitle : '') }}">
                        @if($errors->has('subtitle'))
                            <em class="invalid-feedback">
                                {{ $errors->first('sub_title') }}
                            </em>
                        @endif
                        
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">{{ trans('global.itinerary.fields.description') }}</label>
                        <textarea id="description" name="description" class="form-control summernote ">{{ old('description', isset($itinerary) ? $itinerary->description : '') }}</textarea>
                        @if($errors->has('description'))
                            <em class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.itinerary.fields.description_helper') }}
                        </p>
                    </div>
                    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label for="price">{{ trans('global.itinerary.fields.price') }} {{ $itinerary->currency->symbol }}</label>
                        <input type="hidden" name="currency_id" value="{{ $itinerary->currency->id }}">
                        <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($itinerary) ? $itinerary->price : '') }}" step="0.01">
                        @if($errors->has('price'))
                            <em class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.itinerary.fields.price_helper') }}
                        </p>
                    </div>
                        
                </div>
            </div>
        
            <div class="card">
                <div class="card-header">
                    Additional Informations
                </div>

                <div class="card-body">
                    <ul class="nav nav-pills" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="quick-look-tab" data-toggle="tab" href="#quick-look" role="tab" aria-controls="quick-look"
                            aria-selected="true">Quick Look</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="detailed-itinerary-tab" data-toggle="tab" href="#detailed-itinerary" role="tab" aria-controls="detailed-itinerary"
                            aria-selected="false">Detailed Itinerary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="costs-tab" data-toggle="tab" href="#costs" role="tab" aria-controls="costs"
                            aria-selected="false">Costs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="include-costs-tab" data-toggle="tab" href="#costs-include" role="tab" aria-controls="costs-include"
                            aria-selected="false">Costs Include</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="exclude-costs-tab" data-toggle="tab" href="#costs-exclude" role="tab" aria-controls="costs-exclude"
                            aria-selected="false">Costs Exclude</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map"
                            aria-selected="false">Map</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="general-information-tab" data-toggle="tab" href="#general-information" role="tab" aria-controls="general-information"
                            aria-selected="false">General Information</a>
                        </li>
                    </ul>
                    <div class="tab-content without-border" id="myTabContent">

                        <div class="tab-pane fade show active" id="quick-look" role="tabpanel" aria-labelledby="quick-look-tab">
                            <textarea id="quick-look-summer" name="quick_look" class="form-control summernote ">{{ old('quick_look', isset($itinerary) ? $itinerary->quick_look : '') }}</textarea>
                        </div>
                        <div class="tab-pane fade" id="detailed-itinerary" role="tabpanel" aria-labelledby="detailed-itinerary-tab">
                            <textarea id="quick-look-summer1" name="detailed_itinerary" class="form-control summernote ">{{ old('detailed_itinerary', isset($itinerary) ? $itinerary->detailed_itinerary : '') }}</textarea>
                        </div>
                        <div class="tab-pane fade" id="costs" role="tabpanel" aria-labelledby="costs-tab">
                            <textarea id="quick-look-summer2" name="costs" class="form-control summernote ">{{ old('costs', isset($itinerary) ? $itinerary->costs : '') }}</textarea>    
                        </div>
                        <div class="tab-pane fade" id="costs-include" role="tabpanel" aria-labelledby="costs-include-tab">
                            <textarea id="quick-look-summer3" name="cost_include" class="form-control summernote ">{{ old('cost_include', isset($itinerary) ? $itinerary->cost_include : '') }}</textarea>    
                        </div>
                        <div class="tab-pane fade" id="costs-exclude" role="tabpanel" aria-labelledby="costs-exclude-tab">
                            <textarea id="quick-look-summer4" name="cost_exclude" class="form-control summernote ">{{ old('cost_exclude', isset($itinerary) ? $itinerary->cost_exclude : '') }}</textarea>    
                        </div>
                        <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
                            <div class="card-body">
								<div class="map-img">
									@if(isset($itinerary->map) )
										<img id="MapID" class="map-thumbnail" src="{{ url('/storage/images/itinerary/maps/'.$itinerary->map) }}" alt="Image"><br>
									@else
										<img id="MapID" class="map-thumbnail" src="{{url('images/placeholder.png')}}" alt="Image"><br>
									@endif
									
								</div>
                                <a href="#" class="map-img-btn">Click to add Map</a>
                                <input type="file" name="map" onchange="mapURL(this);" style="display:none" />
                            </div>   
                        </div>
                        

                        <div class="tab-pane fade" id="general-information" role="tabpanel" aria-labelledby="general-information-tab">
                            <!--textarea  name="general_information" class="form-control summernote ">{{ old('general_information', isset($itinerary) ? $itinerary->general_information : '') }}</textarea-->
                            <div class="panel-group" id="accordion">
                                @if(isset($itinerary->general_information) && $itinerary->general_information !='' )
                                    @foreach(json_decode($itinerary->general_information) as $key=>$general_info )
                                        <div class="panel panel-default template">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#accordian{{$key}}">
                                                        <input type="text"  name="general_information[{{$key}}]['title']" value="{{$general_info->title}}">
                                                    </a>
                                                    <button type="button" class="close accordian-close pull-right" >
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </h4>
                                            
                                            </div>
                                            <div id="accordian{{$key}}" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <textarea name="general_information['{{$key}}']['description']">{{$general_info->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <div class="panel panel-default template">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#accordian0">
                                                <input type="text"  name="general_information[0][title]">
                                            </a>
                                            <button type="button" class="close accordian-close pul-right" >
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </h4>
                                    
                                    </div>
                                    <div id="accordian0" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <textarea name="general_information[0][description]"></textarea>
                                        </div>
                                    </div>
                                </div>
                                @endif
            
                            </div>
                            <br />
                            <button class="btn btn-lg btn-primary btn-add-panel">
                                <i class="fa fa-plus"></i> Add new panel
                            </button>
                        </div>

                    </div>
                    
                </div>

            </div>
            
            <!--activity points-->
            <div class="card">
                <div class="card-header">
                    Activity Points
                </div>
                
                <div class="card-body">
                    <textarea name="activity_points" class="form-control summernote ">{{ old('activity_points', isset($itinerary) ? $itinerary->activity_points : '') }}</textarea>
                </div>    
            </div> 
            <!--activity points end-->  

            <!--Highlights-->
            <div class="card">
                <div class="card-header">
                    Highlights
                </div>
                
                <div class="card-body">
                    <textarea name="highlights" class="form-control summernote ">{{ old('highlights', isset($itinerary) ? $itinerary->highlights : '') }}</textarea>
                </div>    
            </div> 
            <!--highlight end--> 

        
        <!--Schecule-->
        <div class="card">
            <div class="card-header">
                Booking Dates
            </div>
            
            <div class="card-body">
                @forelse($itinerary->schedule as $key=>$schedule)
                    <div class="row dynamic-schedule">
                        <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <input type="text" data-attr="from-date" autocomplete="off" class="form-control datepicker from-date" id="from_date_1" name="schedule[{{$key}}][from_date]" value="{{ \Carbon\Carbon::parse($schedule->from_date)->format('m/d/Y') }}" placeholder="From Date">
                            </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="input-group">
                                <input type="text" data-attr="to-date" autocomplete="off" class="form-control datepicker to-date"  id="to_date_1" name="schedule[{{$key}}][to_date]" value="{{ \Carbon\Carbon::parse($schedule->to_date)->format('m/d/Y') }}" placeholder="To Date">
                                <span class="input-group-btn">  
                                    <button type="button" class="mb-xs mr-xs btn btn-danger removemore" data-url="{{ route('admin.itineraries.scheduleDestroy') }}" data-value="{{$schedule->id}}"><i class="fa fa-remove"></i></button> 
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="row dynamic-schedule">
                        <div class="col-sm-6 nopadding">
                            <div class="form-group">
                                <input type="text" data-attr="from-date" autocomplete="off" class="form-control datepicker from-date" id="from_date_1" name="schedule[0][from_date]" value="" placeholder="From Date">
                            </div>
                        </div>
                        <div class="col-sm-6 nopadding">
                            <div class="input-group">
                                <input type="text" data-attr="to-date" autocomplete="off" class="form-control datepicker to-date"  id="to_date_1" name="schedule[0][to_date]" value="" placeholder="To Date">
                                <span class="input-group-btn">
                                    <button type="button" class="mb-xs mr-xs btn btn-danger removemore" data-url="{{ route('admin.itineraries.scheduleDestroy') }}" data-value=""><i class="fa fa-remove"></i></button> 
                                </span>
                            </div>
                        </div>
                    </div>
                @endforelse
                <button class="btn btn-primary addmore" type="button" > <i class="fa fa-plus"></i> Add new schedule </button>
            </div>    
        </div> 
        <!--Schedule end-->
        </div>
        <!--Right sidebar-->

        <div class="col-md-4">
        
            <div class="card">
                <div class="card-header">
                    Publish
                </div>
                <div class="card-body">

                    <div class="itenary-status">

                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="hot_deal" value="0">
                            <input type="checkbox" name="hot_deal" value="1" class="custom-control-input" id="defaultUnchecked" {{ $itinerary->hot_deal == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="defaultUnchecked">Is Hot Deal?</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="hidden" name="fixed_diparture" value="0">
                            <input name="fixed_diparture" type="checkbox" value="1" class="custom-control-input" id="defaultUnchecked1" {{ $itinerary->fixed_diparture == '1' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="defaultUnchecked1">Is Fixed Departure?</label>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Activity Status</label>
                            <select class="form-control" name="status">
                                <option value="active" {{ $itinerary->status=='active' ? 'selected' : '' }}>Active</option>
                                <option value="in_active" {{ $itinerary->status=='in_active' ? 'selected' : '' }}>In Active</option>
                            </select>
                        </div>    
                    </div>

                    <div class="col-md-12">
                        <hr/>

                    </div>
                    <div class="publish-btn">
                
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.itinerary.publish_itinerary') }}">
                        
                    </div>

                </div>
            
            </div>
            <!--PUBLISH STATUS END-->
            <!--Rating-->
            <div class="card">
                <div class="card-header">
                    Rating
                </div>
                <div class="card-body">
                    <div class="custom-control custom-radio">
                        <input type="radio" value="1" class="custom-control-input" id="customRadioEasy" name="rating" {{$itinerary->rating == '1'  ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customRadioEasy">Easy</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="2" class="custom-control-input" id="customRadioModerate" name="rating" {{$itinerary->rating == '2'  ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customRadioModerate">Moderate</label>
                    </div>  
                    <div class="custom-control custom-radio">
                        <input type="radio" value="3" class="custom-control-input" id="customRadioDifficult" name="rating" {{$itinerary->rating == '3'  ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customRadioDifficult">Difficult</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" value="4" class="custom-control-input" id="customRadioHard" name="rating" {{$itinerary->rating == '4'  ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customRadioHard">Hard</label>
                    </div>
                </div>        
            </div>
            <!--Rating End -->
            <!--Destinations-->
            <div class="card">
                <div class="card-header">
                    Destinations
                </div>
                <div class="card-body">
                    @php $selected_destination_id = array(); @endphp
                    @foreach($itinerary->destinations as $selected_destination)
                         @php $selected_destination_id[] = $selected_destination->id; @endphp
                    @endforeach
                    
                    @forelse($destinations as $destination)
                        <div class="custom-control custom-checkbox">
                            
                                @if(in_array($destination->id, $selected_destination_id))
                                    <input type="checkbox" name="destination_id[]" value="{{ $destination->id }}" class="custom-control-input" checked id="destination-{{ $destination->id }}">
                                @else
                                    <input type="checkbox" name="destination_id[]" value="{{ $destination->id }}" class="custom-control-input" id="destination-{{ $destination->id }}">
                                @endif
                                <label class="custom-control-label" for="destination-{{ $destination->id }}">
                                {{ $destination->title }}
                            </label>
                        </div>
                        @empty
                        <p>No Destination added yet. <a href="{{ route("admin.destinations.create") }}">Add Activity</a></p>
                    @endforelse    
                </div>        
            </div>
            <!--Destinations End -->

            <!--Activities-->
            <div class="card">
                <div class="card-header">
                    Activities
                </div>
                <div class="card-body">
                    @php $selected_activity_id = array(); @endphp
                    @foreach( $itinerary->activities as $selected_activity )
                         @php $selected_activity_id[] = $selected_activity->id; @endphp
                    @endforeach

                    @forelse($activities as $activity)
                        <div class="custom-control custom-checkbox">
                            @if(in_array($activity->id, $selected_activity_id))
                                <input  id="activity-{{ $activity->id }}" checked value="{{ $activity->id }}" type="checkbox" name="activity_id[]" class="custom-control-input" >
                            @else
                                <input  id="activity-{{ $activity->id }}" value="{{ $activity->id }}" type="checkbox" name="activity_id[]" class="custom-control-input" >
                            @endif
                            <label class="custom-control-label" for="activity-{{ $activity->id }}">
                                {{ $activity->title }}
                            </label>
                        </div>
                        @empty
                        <p>No Activity added yet. <a href="{{ route("admin.activities.create") }}">Add Activity</a></p>
                    @endforelse
                </div>        
            </div>
            <!--Activities End -->

            <!--Feature Image-->
            <div class="card">
                <div class="card-header">
                    Feature Image
                </div>
                <div class="card-body">
                    <div class="thumbnail-img">
                        @if(isset($itinerary->feature_img) )
                            <img id="ImdID" class="thumbnail" src="{{ url('/storage/images/itinerary/featureImages/'.$itinerary->feature_img) }}" alt="Image"><br>
                        @else
                            <img id="ImdID" class="thumbnail" src="{{url('images/placeholder.png')}}" alt="Image"><br>
                        @endif
                    </div>
                    <a href="#" class="feature-img-btn">Add Feature Image</a>
                    <input type="file" name="feature_img" value='' onchange="readURL(this);" style="display:none" />
                </div>        
            </div>
            <!--Feature End -->

            <!--Gallery Images-->
            <div class="card">
                <div class="card-header">
                    Gallery Images
                </div>
                <div class="card-body">
                    <div class="preview-images-zone">
                        @if( isset($itinerary->gallery_img ) )
                            @foreach(json_decode($itinerary->gallery_img) as $key=>$gallery)
                                <div class="preview-image preview-show-{{$key}}">
                                    <input type="hidden" name="gallery_upload_img[]" value="{{ $gallery }}">
                                    <div class="image-cancel" data-no="{{$key}}">x</div>
                                    <div class="image-zone"><img id="pro-img-{{$key}}" src="{{ url('/storage/images/itinerary/galleryImages/'.$gallery) }}"></div>
                               </div>
                            @endforeach
                        @endif
                    </div>
                    <fieldset class="form-group">
                        <a href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                        <input type="file" id="pro-image" value="{{$itinerary->gallery_img}}" name="gallery_img[]" style="display:none;" class="form-control" multiple>
                    </fieldset>
                </div>        
            </div>
            <!--Gallery Images End -->

        </div>

    </div>        

</form>
@endsection
