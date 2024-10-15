@foreach($homeMenuData as $homeMen)

    @if($homeMen->slug=='about-us')
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="display-4 mb-4"></h1>

                </div>
                <div class="row g-5">
                    @foreach($homeMen->homePage(1) as $about)
                        <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                            <div class="about-item-content bg-white rounded p-5 h-100">
                                <h1 class="display-4 mb-4">{{$about->title}}</h1>
                                <p>
                                    {!! getLimitDescription($about->description) !!}
                                </p>

                                <a class="btn btn-primary  py-3 px-5" href="{{url($homeMen->slug).'/'.$about->slug}}">More
                                    Information</a>
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
                    @endforeach
                </div>

            </div>
        </div>

    @else

        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="display-4 mb-4">{{ucfirst($homeMen->name)}}</h1>

                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($homeMen->homePage(4) as $service)
                        <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item">
                                <div class="service-img">
                                    @if($service->image)
                                        <img src="{{url($service->image)}}" style="height: 250px;"
                                             class="img-fluid rounded-top w-100" alt="{{$service->title}}">
                                    @else
                                        <img src="{{url('icons/notfound.png')}}" style="height: 250px;"
                                             class="img-fluid rounded-top w-100"
                                             alt="{{$service->title}}">
                                    @endif

                                </div>
                                <div class="service-content p-4">
                                    <div class="service-content-inner">
                                        <a href="{{url($homeMen->slug).'/'.$service->slug}}"
                                           class="d-inline-block h4 mb-4">
                                            {{$service->title}}
                                        </a>
                                        <p class="mb-4">
                                            {!! getLimitDescription($service->description,200)  !!}
                                        </p>
                                        <a class="btn btn-primary rounded-pill py-2 px-4"
                                           href="{{url($homeMen->slug).'/'.$service->slug}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.2s">
                        <a class="btn btn-primary rounded-pill py-3 px-5"
                           href="{{url($homeMen->slug)}}">More {{$homeMen->name}}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endforeach
