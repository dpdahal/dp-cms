@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h2>
                                    <i class="bi bi-card-image"></i> Upload New Files
                                    <a href="{{route('manage-media.index')}}"
                                       class="pull-right btn btn-primary btn-sm"><i
                                            class="bi bi-arrow-right-circle-fill"></i> Show Media Files</a>

                                </h2>
                                @include('backend.layouts.message')
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <form action="{{route('add-media-file')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="album_id">Album:
                                            <a style="color: red;text-decoration: none;">{{$errors->first('album_id')}}</a>
                                        </label>
                                        <select name="album_id" id="album_id" class="form-control">
                                            @foreach($albumsData as $album)
                                                <option value="{{$album->id}}">{{$album->name}}</option>
                                            @endforeach
                                        </select>
                                        <a href="{{route('manage-album.index')}}">Add Album if not list</a>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="file">File:
                                            <a style="color: red;text-decoration: none;">{{$errors->first('file')}}</a>
                                        </label>
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-save2-fill"></i> Save File
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                                <p>
                                    You are using the browser’s built-in file uploader.
                                    The Diyan uploader includes multiple file selection and drag and drop capability.
                                    <a href="{{route('manage-media.create')}}"> Switch to the multi-file uploader</a>
                                </p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')
    <script>
        function customToggleBox() {
            let albumCreate = document.getElementById('albumCreate');
            if (albumCreate.style.display === 'block') {
                albumCreate.style.display = 'none';
            } else {
                albumCreate.style.display = 'block';
            }
        }

        async function getAlbum($type = 'asc') {
            await axios.get("{{route('get-ajax-album').'/'}}" + $type)
                .then(function (response) {
                    let album = response.data.albumData;
                    let output = "<div class='list-group'>";
                    for (let i = 0; i < album.length; i++) {
                        if (i === 0) {
                            document.getElementById('album_id').value = album[i].id;
                            output += `<label class='list-group-item list-group-item-action'><input type='radio'  name='album_id_name' value='${album[i].id}' checked> <i class="bi bi-folder"></i> ${album[i].name} </label>`;
                        } else {
                            output += `<label class='list-group-item list-group-item-action'><input type='radio'  name='album_id_name' value='${album[i].id}'> <i class="bi bi-folder"></i> ${album[i].name} </label>`;
                        }
                    }
                    output += "</div>";
                    document.getElementById('album').innerHTML = output;

                })
                .catch(function (error) {
                    console.log(error);
                });

            document.getElementsByName('album_id_name').forEach(function (element) {
                element.addEventListener('change', function () {
                    document.getElementById('album_id').value = this.value;
                });
            });
        }

        getAlbum();

        document.getElementById('addAlbumName').addEventListener('click', function () {
            let album_name = document.getElementById('album_name').value;
            if (album_name === '') {
                document.getElementById('album_name_error').innerHTML = 'Album Name is required';
                return false;
            } else {
                axios.post("{{route('get-ajax-album')}}", {
                    album_name: album_name
                })
                    .then(function (response) {
                        if (response.data.success) {
                            document.getElementById('album_name_error').innerHTML = '';
                            getAlbum('desc');
                            document.getElementById('album_name').value = '';
                        } else {
                            document.getElementById('album_name_error').innerHTML = response.data.error;
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        });

    </script>

@endsection
