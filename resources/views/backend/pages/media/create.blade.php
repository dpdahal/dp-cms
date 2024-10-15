@extends('backend.master.main')
@section('content')
    <style>
        #album {
            height: 200px;
            overflow-y: scroll;
        }
        #albumCreate {
            display: none;
        }
    </style>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <h2>
                                    <i class="bi bi-card-image"></i> Upload New Media
                                    <a href="{{route('manage-media.index')}}"
                                       class="pull-right btn btn-primary btn-sm"><i class="bi bi-arrow-right-circle-fill"></i> Show Media Files</a>

                                </h2>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 style="font-size: 18px;font-weight: bold;"> Album List</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div id="album"></div>
                                            </div>
                                            <div class="col-md-12 mt-5 mb-2">
                                                <button  style="border:none;background: none;font-size: 14px;font-weight: bold;color: #0a53be;" onclick="customToggleBox()">Create Album</button>
                                            </div>
                                            <div class="col-md-12" id="albumCreate">
                                                <div class="form-group mb-2">
                                                    <label for="album_name">Album Name</label>
                                                    <input type="text" id="album_name" class="form-control">
                                                    <span class="text-danger" id="album_name_error"></span>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <button class="btn btn-success" id="addAlbumName">
                                                        <i class="bi bi-plus-circle"></i> Add Album
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row mt-4">
                                            <form action="{{ route('manage-media.store') }}" method="post"
                                                  enctype="multipart/form-data"
                                                  id="image-upload"
                                                  class="dropzone" style="min-height:300px;">
                                                @csrf
                                                <input type="hidden" id="album_id" name="album_id" value="1">
                                                <div>
                                                    <h1 style="font-size: 18px;text-align: center;margin-top:10px;">
                                                        Upload manual Image By Click On
                                                        Box</h1>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3 mt-3">
                                                <a href="{{route('add-media-file')}}" style="color: #0027e5;text-decoration: none;">
                                                    <i class="bi bi-plus"></i> Add manual file if not working above</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
