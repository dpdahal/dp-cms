@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <h2>
                                <i class="bi bi-plus-circle"></i> Add Team
                            </h2>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('manage-team.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="user_id">Select User:
                                                <span class="text-danger">*
                                            {{ $errors->has('user_id') ? $errors->first('user_id') : '' }}
                                            </span>
                                            </label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value=""></option>
                                                @foreach ($adminData as $admin)
                                                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="member_type_id">Member Types:
                                                <span class="text-danger">*
                                                {{ $errors->has('member_type_id') ? $errors->first('member_type_id') : '' }}

                                            </label>
                                            <select name="member_type_id" id="member_type_id" class="form-control">
                                                <option value=""></option>
                                                @foreach ($membersTypeData as $type)
                                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <button class="btn btn-success w-100">Add Out Team</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-2 mt-3 mb-3">
                            <h2>
                                <i class="bi bi-eye-fill"></i> Show Our Team
                            </h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S.n</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($teamData as $key => $team)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $team->user->name }}</td>
                                        <td>{{ $team->memberType->type }}</td>
                                        <td style="width: 15%">
                                            <form action="{{route('manage-team.destroy',$team->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('manage-team.edit',$team->id)}}"
                                                   class="btn btn-primary btn-sm">Edit</a>
                                                <button class="btn btn-danger btn-sm">Delete</button>
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
