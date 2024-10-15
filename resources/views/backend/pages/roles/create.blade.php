@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mt-2 mb-2 p-3">
                            <div class="pull-left">
                                <h2>Create New Role</h2>
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                        <div class="col-md-12">
                            <form action="{{route('roles.store')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Role Name:
                                    <span class="text-danger">*
                                    {{$errors->first('name')}}
                                    </span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                             value="{{old('name')}}"
                                           class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Permission:
                                        {{$errors->first('permission')}}
                                    </label>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>
                                            <input type="checkbox" name="permission[]"
                                                   value="{{$value->id}}"
                                                    @if(is_array(old('permission')) && in_array($value->id, old('permission'))) checked @endif

                                            > {{ $value->name }}
                                        </label>

                                    @endforeach
                                </div>
                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')

@endsection

