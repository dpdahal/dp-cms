<?php

function getLimitDescription($text)
{
    $limit = 100;
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
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Blog</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-primary">Blog</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">

            <div class="row g-4 justify-content-center">
                @foreach($allBlogData as $blog)
                    <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="blog-item">
                            <div class="blog-img">
                                @if($blog->image)
                                    <img src="{{url($blog->image)}}" style="height: 250px;"
                                         class="img-fluid rounded-top w-100" alt="">
                                @else
                                    <img src="{{url('icons/notfound.png')}}" style="height: 250px;"
                                         class="img-fluid rounded-top w-100"
                                         alt="{{$blog->title}}">
                                @endif
                                <div class="blog-categiry py-2 px-4">
                                    @if(count($blog->postCategory)>0)
                                        @foreach($blog->postCategory as $category)
                                            <a href="#" class="badge bg-primary">{{$category->name}}</a>
                                        @endforeach

                                    @endif
                                </div>
                            </div>
                            <div class="blog-content p-4">
                                <div class="blog-comment d-flex justify-content-between mb-3">
                                    <div class="small"><span class="fa fa-user text-primary"></span>
                                        {{$blog->user->name}}

                                    </div>
                                    <div class="small"><span class="fa fa-calendar text-primary"></span>
                                        {{date('d M Y', strtotime($blog->created_at))}}
                                    </div>
                                    <div class="small"><span class="fa fa-comment-alt text-primary"></span>
                                        {{$blog->comments->count()}} Comments
                                    </div>
                                </div>
                                <a href="{{route('blog',$blog->slug)}}" class="h4 d-inline-block mb-3">
                                    {{$blog->title}}
                                </a>
                                <p class="mb-3">
                                    {!!  getLimitDescription($blog->description) !!}
                                </p>
                                <a href="{{route('blog',$blog->slug)}}" class="btn p-0">Read More <i
                                            class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Blog End -->

@endsection
