@extends('backend.pages.media.media-layout')
@section('media-content')
    <div class="row">
        <form action="{{route('delete-all-media-files')}}" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="type" id="" class="form-control form-control-sm">
                            <option value="">----Select----</option>
                            <option value="delete">Delete</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2" style="padding-left: 0;">
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">Apply</button>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr class="table-dark">
                    <th>
                        <input type="checkbox" id="select_all">
                    </th>
                    <th>File</th>
                    <th>Album Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($gallery as $image)
                    <tr>
                        <td>
                            <input class="checkbox" name="checkbox[]"
                                   value="{{$image->id}}" type="checkbox">

                        </td>
                        <td>
                            @if(in_array($image->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                <img src="{{ url($image->url) }}" alt="" class="img-fluid"
                                     style="width: 100px; height: 100px;">
                            @elseif (in_array($image->mime_type,['video/mp4', 'video/ogg', 'video/webm']))
                                <a href="" style="text-decoration: none;">
                                    <img src="{{url('icons/video.png')}}" alt="">
                                </a>
                            @elseif (in_array($image->mime_type,['audio/mpeg', 'audio/ogg', 'audio/wav']))
                                <a href="" style="text-decoration: none;color: black;">
                                    <img src="{{url('icons/audio.png')}}" alt="">
                                </a>
                            @elseif (in_array($image->mime_type,['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/zip', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']))
                                <a href="" style="text-decoration: none;color: black;">
                                    <img src="{{url('icons/document.png')}}" alt="" style="width: 100px;height: 100px;">
                                </a>
                            @else
                                <a href="" style="text-decoration: none;color: black;">
                                    <img src="{{url('icons/default.png')}}" alt="" style="width: 100px;height: 100px;">
                                </a>
                            @endif

                        </td>
                        <td>{{$image->album->name}}</td>
                        <td>{{$image->created_at->diffForHumans()}}</td>
                        <td width="15%">
                            <a href="{{url($image->url)}}" class="btn btn-info btn-sm"
                               title="View Files"
                               target="_blank">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <a href="{{url($image->url)}}"
                               download
                               class="btn btn-success btn-sm"
                               title="Download Files">
                                <i class="bi bi-download"></i>
                            </a>
                            <a href="{{route('manage-media.edit', $image->id)}}"
                               title="Update File"
                               class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i></a>
                            <form action="{{route('manage-media.destroy', $image->id)}}" method="post"
                                  class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        title="Delete Files"
                                        onclick="return confirm('Are you sure you want to delete this image?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
    </div>
@endsection
@section('scripts')

@endsection
