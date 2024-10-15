@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12 mt-3 mb-4">
                            <h2>
                                <i class="bi bi-eye-fill"></i> Dashboard
                            </h2>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>
                    <div class="row">
                        @foreach($accountTypes as $account)
                            <div class="col-md-3">
                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title">{{ucfirst($account->name)}}</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6>{{$account->user->count()}}</h6>
                                                <span class="text-danger small pt-1 fw-bold">
                                                    Total
                                                </span>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </section>

    </main>

@endsection

@section('scripts')
    @parent
    <script>


    </script>

@endsection

