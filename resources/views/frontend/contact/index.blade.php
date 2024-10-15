@extends('frontend.app')
@section('content')
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Contact Us</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('index')}}l">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-primary">Contact</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="col-md-12">
                @include('lib.message')
            </div>
            <div class="col-md-12">
                <form action="{{route('contact')}}" method="post">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="name">Name:
                            <span class="text-danger">*
                            {{$errors->has('name') ? $errors->first('name') : ''}}
                        </span>
                        </label>
                        <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email:
                            <span class="text-danger">*
                            {{$errors->has('email') ? $errors->first('email') : ''}}
                        </span>
                        </label>
                        <input type="email" class="form-control" value="{{old('email')}}" id="email" name="email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="subject">Subject:
                            <span class="text-danger">*
                            {{$errors->has('subject') ? $errors->first('subject') : ''}}
                        </span>
                        </label>
                        <input type="text" class="form-control" value="{{old('subject')}}" id="subject" name="subject">
                    </div>
                    <div class="form-group mb-2">
                        <label for="message">Message:
                            <span class="text-danger">*
                            {{$errors->has('message') ? $errors->first('message') : ''}}
                        </span>
                        </label>
                        <textarea class="form-control" id="message" name="message">{{old('message')}}</textarea>
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-12">

            </div>

        </div>
    </div>
@endsection
