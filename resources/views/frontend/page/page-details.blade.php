@extends('frontend.app')

@section('content')

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">
                {{ucfirst($menuData->name)}}
            </h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active text-primary">
                    {{ucfirst($menuData->name)}}
                </li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
    <!-- FAQs Start -->
    <div class="container-fluid faq-section bg-light py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-8">
                    <h1>{{$pageData->title}}</h1>
                    @if($pageData->image)
                        <img src="{{url($pageData->image)}}" class="img-fluid w-100" alt="">
                    @else
                        <img src="{{url('icons/notfound.png')}}" class="img-fluid w-100" alt="">
                    @endif
                    <p class="mt-4">
                        {!! $pageData->description !!}
                    </p>
                </div>
                <div class="col-md-4">
                    <h1>Related Page</h1>
                    <ul>
                        @foreach($relatedPage as $rpage)
                            <li>
                                <a href="{{url($menuData->slug).'/'.$rpage->slug}}">
                                    {{$rpage->title}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- FAQs End -->
@endsection
