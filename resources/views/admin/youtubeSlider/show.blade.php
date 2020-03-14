@extends('layouts.admin')
@section('content')
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    @forelse(json_decode($slide->photo) as $key=>$value)
      <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"></li>
    @empty

    @endforelse  
  </ul>

  <!-- The slideshow -->
  <div class="carousel-inner">
    @forelse(json_decode($slide->photo) as $key=>$value)
      <div class="carousel-item {{$key == 0 ? 'active' : ''}} ">
        <img src="{{ url('/storage/images/sliders/'.$value) }}" alt="Los Angeles">
      </div>
    @empty

    @endforelse 
  </div>

  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>

</div>
@endsection