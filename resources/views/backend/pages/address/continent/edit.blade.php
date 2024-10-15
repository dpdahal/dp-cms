<?php
$columnName = "image";
?>

@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-4 mb-2">
                            <h3>
                                <i class="fa fa-globe" aria-hidden="true"></i>
                                Update Continent
                                <a href="{{route('continents.index')}}" class="btn btn-primary btn-sm float-end">Show Continent</a>
                            </h3>
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
                            <form action="{{ route('continents.update',$continentData->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12 mb-2">
                                    <label for="continent_name">Continent Name
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('continent_name')}}
                                        </a>
                                    </label>
                                    <input type="text" class="form-control"
                                           value="{{$continentData->continent_name}}"
                                           id="continent_name" name="continent_name">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="continent_code">Continent Code
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('continent_code')}}
                                        </a>
                                    </label>
                                    <input type="text" class="form-control"
                                           value="{{$continentData->continent_code}}"
                                           id="continent_code" name="continent_code">

                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="description">Description:
                                        <a style="color: red;text-decoration: none">
                                            {{$errors->first('description')}}
                                        </a>
                                    </label>
                                    <textarea class="form-control" id="description"
                                              name="description">{{$continentData->description}}</textarea>
                                </div>
                                <div class="col-md-12 mb-2">
                                    @include('backend.layouts.update-image',['tableName'=>$continentData->getTable(),'id'=>$continentData->id])

                                </div>


                                <div class="mt-3">
                                    <button class="btn btn-primary">Update Continent</button>
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




