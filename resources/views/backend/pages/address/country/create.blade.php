@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4 mb-2">
                            <h2>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Add Country
                                <a href="{{route('countries.index')}}" class="btn btn-primary btn-sm float-end">Show
                                    Country</a>
                            </h2>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('countries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 mb-2">
                                    <label for="continent_id">Select Continent:
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('continent_id')}}
                                        </a>

                                    </label>
                                    <select class="form-control" id="continent_id" name="continent_id">
                                        <option value="" selected disabled>Select Continent</option>
                                        @foreach($continentsData as $continent)
                                            <option value="{{$continent->id}}"
                                                {{old('continent_id')==$continent->id?'selected':''}}

                                            >{{$continent->continent_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="country_name">Country Name
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('country_name')}}
                                        </a>
                                    </label>
                                    <input type="text" class="form-control"
                                           value="{{old('country_name')}}"
                                           id="country_name" name="country_name">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="code">Country Code
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('code')}}
                                        </a>
                                    </label>
                                    <input type="text" class="form-control"
                                           value="{{old('code')}}"
                                           id="code" name="code">

                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="description">Description:
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('description')}}
                                        </a>
                                    </label>
                                    <textarea class="form-control" id="description"
                                              name="description">{{old('description')}}</textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="image">Image
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('image')}}
                                        </a>
                                    </label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-primary">Add Country</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </main>
@endsection


@section('scripts')
    @parent
    <script>
        $(document).ready(function () {


            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection




