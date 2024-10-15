@extends('frontend.app')

@section('content')

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Frequently Asked Questions</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
                <li class="breadcrumb-item active text-primary">FAQs</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
    <!-- FAQs Start -->
    <div class="container-fluid faq-section bg-light py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-12 wow fadeInLeft" data-wow-delay="0.2s">
                    <div class="h-100">
                        <div class="mb-5">
                            <h4 class="text-primary">Some Important FAQ's</h4>
                            <h1 class="display-4 mb-0">Common Frequently Asked Questions</h1>
                        </div>
                        <div class="accordion" id="accordionExample">
                            @foreach($faqData as $key=>$fac)
                                @if($key==0)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button border-0" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                Q: {{$fac->question}}
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show active"
                                             aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body rounded">
                                                A: {!! $fac->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo{{$key}}">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo{{$key}}" aria-expanded="false"
                                                    aria-controls="collapseTwo">
                                                Q: {{$fac->question}}
                                            </button>
                                        </h2>
                                        <div id="collapseTwo{{$key}}" class="accordion-collapse collapse"
                                             aria-labelledby="headingTwo{{$key}}"
                                             data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                A: {!! $fac->answer !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- FAQs End -->
@endsection
