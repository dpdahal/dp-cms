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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">About Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active text-primary">About</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid bg-light about py-5">
        <div class="container py-5">
            <div class="row g-5">
                @foreach($menuData->page as $key=>$about)
                    @if($key%2==0)
                        <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-item-content bg-white rounded p-5 h-100">
                                <h1 class="display-4 mb-4">{{$about->title}}</h1>
                                <p>
                                    {!! getLimitDescription($about->description) !!}
                                </p>

                                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{url($menuData->slug).'/'.$about->slug}}">More Information</a>
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                            <div class="bg-white rounded p-5 h-100">
                                <div class="row g-4 justify-content-center">
                                    <div class="col-12">
                                        <div class="rounded bg-light">
                                            @if($about->image)
                                                <img src="{{url($about->image)}}" class="img-fluid rounded w-100"
                                                     alt="">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.2s">
                            <div class="bg-white rounded p-5 h-100">
                                <div class="row g-4 justify-content-center">
                                    <div class="col-12">
                                        @if($about->image)
                                            <img src="{{url($about->image)}}" class="img-fluid rounded w-100"
                                                 alt="">
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-item-content bg-white rounded p-5 h-100">
                                <h1 class="display-4 mb-4">{{$about->title}}</h1>
                                <p>
                                    {!! getLimitDescription($about->description) !!}
                                </p>

                                <a class="btn btn-primary rounded-pill py-3 px-5" href="{{url($menuData->slug).'/'.$about->slug}}">More Information</a>
                            </div>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
