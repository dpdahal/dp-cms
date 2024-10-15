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
                                Manage Country
                                <a href="{{route('countries.create')}}"
                                   class="btn btn-primary btn-sm float-end">Add Country</a>
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
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <td>S.n</td>
                                    <td>Country Name</td>
                                    <td>Code</td>
                                    <td>Action</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countriesData as $key=>$country)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$country->country_name}}

                                        </td>
                                        <td>{{$country->code}}</td>
                                        <td width="15%">
                                            <a href="{{route('countries.edit',$country->id)}}"
                                               class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{route('countries.destroy',$country->id)}}" method="post"
                                                  style="display: inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete?')">Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection


