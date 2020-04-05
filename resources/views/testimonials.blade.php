@extends('layouts.frontend')
@section('content')
    <section class="about_us grey_outer8">
        <div class="container">
            <div class="privacy_note">
                <p class="custom6">To assure you that you are in right hand, Here You will read the feed back of our valuable guest those who travelled with us during past years to different destination of India. These valued customer continue returning and refer many more to Himalayan Frontiers.</p>
            </div>
           @forelse($testimonials as $testimonial)
                @php
                    $str = $testimonial->description;
                    $strToReplace   = ["<p>","</p>"];
                    $strFromReplace = ["",""];
                    $description  = str_replace($strToReplace, $strFromReplace, $str);
                @endphp
                <div class="white5">
                    <p>{!! $testimonial->author !!}</p>
                    <p class="color56">{!! $description !!}</p>

                </div>
                @empty

            @endforelse
        </div> 
    </section>
@endsection    