@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <h2>
                                <i class="bi bi-plus-circle"></i> Update Team
                            </h2>
                        </div>
                        <div class="col-md-12">
                            @include('backend.layouts.message')
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('manage-team.update',$teamData->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="user_id">Select User:
                                                <span class="text-danger">*
                                            {{ $errors->has('user_id') ? $errors->first('user_id') : '' }}
                                            </span>
                                            </label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="{{$teamData->user->id}}">
                                                    {{$teamData->user->name}}
                                                </option>
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
                                                <option value="{{$teamData->memberType->id}}">
                                                    {{$teamData->memberType->type}}
                                                </option>
                                                @foreach ($membersTypeData as $type)
                                                    <option value="{{ $type->id }}">{{ $type->type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group mb-2">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control">
                                        {{$teamData->description}}
                                    </textarea>
                                </div>
                                <div class="form-group mb-2">
                                    <button class="btn btn-success w-100">Update Team</button>
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

