@extends('layouts.frontend')
@section('content')
<div class="container">
    <section class="blog_outer">	
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    @forelse($blogs as $blog)
                        <div class="blog1_outer">
                            <img src="{{ url('/storage/images/blogs/featureImages/'.$blog->thumbnails) }}">
                            <h3>{{$blog->title}}</h3>
                            <p>{!! substr($blog->description,0,500) !!}</p>
                            <div class="btn_outer99">
                                <a href="{{route('singleblogs',$blog->slug)}}">
                                    Read More
                                </a>
                            </div>
                        </div>
                    @empty
                    No Blogs Added
                    @endforelse    
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="right_bar4">
                        <div class="img_oit">
                            <a href="https://www.himalayanfrontiers.com/india"><img class="aligncenter size-full wp-image-1733" src="https://www.himalayanfrontiers.com/wp-content/uploads/2014/12/india-destination.png" alt="home-scuba" width="300" height="380"></a>
                        </div>
                        <div class="img_oit">
                            <a href="https://www.himalayanfrontiers.com/nepal"><img class="aligncenter size-full wp-image-1733" src="https://www.himalayanfrontiers.com/wp-content/uploads/2014/12/nepal-destination.png" alt="home-scuba" width="300" height="380"></a>
                        </div>
                        <div class="img_oit">
                            <a href="https://www.himalayanfrontiers.com/bhutan"><img class="aligncenter size-full wp-image-1733" src="https://www.himalayanfrontiers.com/wp-content/uploads/2014/12/bhutan-destination.png" alt="home-scuba" width="300" height="380"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
</div>
@endsection
