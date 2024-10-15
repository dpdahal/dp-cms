@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mt-2 mb-2 p-3">
                            <div class="row">
                                <div class="col-lg-12 margin-tb">
                                    <div class="pull-left">
                                        <h2><i class="bi bi-pencil-square"></i> Update Role</h2>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-success btn-sm" href="{{ route('roles.index') }}"><i class="bi bi-arrow-right-circle-fill"></i> Back</a>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>


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


                            <form action="{{route('roles.update',$role->id)}}" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{$role->name}}"
                                           class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <strong>Permission:</strong>
                                    <br/>
                                    @foreach($permission as $value)
                                        <label>
                                            <input type="checkbox" name="permission[]"
                                                   value="{{$value->id}}"
                                                {{in_array($value->id,$rolePermissions) ? 'checked' : ''}}>
                                            {{$value->name}}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="form-group mb-3">
                                    <button class="btn btn-primary">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </button>
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

