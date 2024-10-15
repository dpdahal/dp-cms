<?php

function getLimitDescription($text)
{
    $limit = 1000;
    if (strlen($text) > $limit) {
        return substr($text, 0, $limit) . '...';
    } else {
        return $text;
    }
}

?>

@extends('frontend.app')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Banner Details</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid bg-light about py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-12">
                    <img src="{{url($banner->image)}}" class="img-fluid" alt="{{$banner->title}}">
                    <h2 class="display-4">{{$banner->title}}</h2>
                    <p class="mt-4">{!! $banner->description  !!}</p>
                    <a href="{{route('contact')}}" class="btn btn-main mt-3">Contact Us</a>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <h1>Related Banner</h1>
                    <ul>
                        @foreach($relatedBanner as $rb)
                            <li><a href="{{route('banner', $rb->slug)}}">{{$rb->title}}</a></li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>

    </div>
    </div>
    <!-- About End -->

@endsection
