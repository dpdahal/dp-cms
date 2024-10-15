@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="card">
                <div class="card-body mb-3 mt-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><i class="bi bi-pencil-square"></i> Edit Gallery
                                    <a href="{{route('manage-media.index')}}"
                                       class="btn btn-success btn-sm pull-right">
                                        <i class="bi bi-arrow-right-circle-fill"></i> Back to Gallery</a>
                                </h3>
                                <hr>
                                @include('backend.layouts.message')
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <form action="{{route('manage-media.update',$gallery->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="update_by_normal_form" value="yes">
                            <div class="row">
                                <div class="col-md-8">
                                    @if(in_array($gallery->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                                        <img src="{{ url($gallery->url) }}" alt="" class="img-fluid">
                                        <hr>
                                        <a href="{{route('edit-image').'/'.$gallery->id}}" class="btn btn-success btn-sm">Edit Image</a>
                                    @elseif (in_array($gallery->mime_type,['video/mp4', 'video/ogg', 'video/webm']))
                                        <video src="{{url($gallery->url)}}" controls style="width: 100%;"></video>
                                    @elseif (in_array($gallery->mime_type,['audio/mpeg', 'audio/ogg', 'audio/wav']))
                                        <audio src="{{url($gallery->url)}}" controls style="width: 100%;"></audio>
                                    @elseif (in_array($gallery->mime_type,['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/zip', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']))
                                        <a href="" style="text-decoration: none;color: black;">
                                            <img src="{{url('icons/document.png')}}" alt="" style="width: 100px;height: 100px;">
                                        </a>
                                    @else
                                        <a href="" style="text-decoration: none;color: black;">
                                            <img src="{{url('icons/default.png')}}" alt="" style="width: 100px;height: 100px;">
                                        </a>
                                    @endif
                                    <div class="form-group mt-3 mb-2">
                                        <label for="alternative_text">Alternative Text</label>
                                        <input type="text" name="alternative_text"
                                               value="{{$gallery->alternative_text}}"
                                               id="alternative_text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title"
                                               name="title"
                                               value="{{$gallery->title}}"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="caption">Caption</label>
                                        <input type="text" id="caption"
                                               name="caption"
                                               value="{{$gallery->caption}}"
                                               class="form-control">
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description">Description</label>
                                        <textarea id="description"
                                                  name="description"
                                                  class="form-control">{{$gallery->description}}</textarea>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <p>Uploaded on: <strong>{{$gallery->created_at}}</strong></p>
                                    <p>File name:<strong>{{$gallery->file_name}}</strong></p>
                                    <p>File Type:<strong>{{$gallery->mime_type}}</strong></p>
                                    <p>Dimensions: <strong>{{$gallery->dimensions}}  pixels</strong>
                                    </p>
                                    <div class="form-group mb-3">
                                        <label for="album_id">Album</label>
                                        <select name="album_id" id="album_id" class="form-control">
                                            @foreach($albumsData as $album)
                                                <option value="{{$album->id}}"
                                                        @if($album->id == $gallery->album_id) selected @endif>{{$album->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group mt-3 mb-3">
                                        <label for="file_url">File Ulr</label>
                                        <input type="url" id="file_url"
                                               value="{{url($gallery->url)}}"
                                               readonly
                                               class="form-control form-control-sm">
                                    </div>
                                    <div class="form-group mt-3 mb-3">
                                        <div id="copy_url_to_clipboard" class="btn btn-secondary btn-sm">Copy url to
                                            clipboard
                                        </div>
                                        <div class="copy_message" style="color: green"></div>
                                    </div>
                                    <div class="form-group mt-3 mb-3">
                                        <button class="btn btn-primary"><i class="bi bi-pencil-square"></i> Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#copy_url_to_clipboard').click(function () {
                var file_url = $('#file_url').val();
                navigator.clipboard.writeText(file_url);
                $('.copy_message').html('Copied successfully');
            });
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });
        });
    </script>

@endsection
