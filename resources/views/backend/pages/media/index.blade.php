@extends('backend.pages.media.media-layout')
@section('media-content')
    <style>
        #myModelBox {
            width: 100%;
            min-height: 800px;
            background: #FFFFFF;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: none;
            padding: 20px;
            bottom: 0;
            border-radius: 10px;
        }

        .mediaBox {
            width: 100%;
            height: 129px;
            background: #d3d3d3;
            position: relative;
            text-align: center;
            padding-top: 12px;
            border: 2px solid #d3d3d3;
        }

        .mediaNameBox {
            width: 100%;
            position: absolute;
            background: white;
            bottom: 0;
        }
    </style>

    <div class="row" id="gallery_ajax_filter_data">
        @foreach($gallery as $image)
            <div class="dp-select-image col-md-2 mb-3" style="cursor: pointer;" onclick="customModelOpenAndHide(this);">
                <input type="hidden" class="image-ids" value="{{$image->id}}">
                @if(in_array($image->mime_type, ['image/jpeg', 'image/png', 'image/jpg']))
                    <img src="{{ url($image->url) }}" alt="" class="img-fluid"
                         style="width: 100%; height: 129px;">
                @elseif (in_array($image->mime_type,['video/mp4', 'video/ogg', 'video/webm']))
                    <div class="mediaBox">
                        <img src="{{url('icons/video.png')}}" alt="">
                        <div class="mediaNameBox">
                            <p>{{$image->file_name}}</p>
                        </div>
                    </div>
                @elseif (in_array($image->mime_type,['audio/mpeg', 'audio/ogg', 'audio/wav']))
                    <div class="mediaBox">
                        <img src="{{url('icons/audio.png')}}" alt="">
                        <div class="mediaNameBox">
                            <p>{{$image->file_name}}</p>
                        </div>
                    </div>

                @elseif (in_array($image->mime_type,['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/zip', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']))
                    <div class="mediaBox">
                        <img src="{{url('icons/document.png')}}" alt="">
                        <div class="mediaNameBox">
                            <p>{{$image->file_name}}</p>
                        </div>
                    </div>
                @else
                    <div class="mediaBox">
                        <img src="{{url('icons/default.png')}}" alt="">
                        <div class="mediaNameBox">
                            <p>{{$image->file_name}}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <div class="container">
        <div id="myModelBox">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <h3>Attachment details</h3>
                        </div>
                        <div class="col-md-2">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button id="previous" class="btn btn-secondary btn-sm"><i
                                        class="bi bi-chevron-double-left"></i></button>
                                <button id="next" class="btn btn-secondary btn-sm"><i
                                        class="bi bi-chevron-double-right"></i></button>
                                <button class="btn btn-danger btn-sm pull-right" id="mediaCloseBox">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-md-12" id="resultBox"></div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        function getAjaxFilterCustomData(type, value) {
            let url = "{{route('get-ajax-search-image')}}";
            let data = {
                type: type,
                value: value
            };
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
            axios.post(url, data).then(function (response) {
                document.getElementById('gallery_ajax_filter_data').innerHTML = response.data.galleryData;
            }).catch(function (error) {
                console.log(error);
            });

        }

        document.querySelector('#search_media_file').addEventListener('keyup', function () {
            let search = this.value;
            getAjaxFilterCustomData('search', search);
        });
        document.querySelector('#media_attachment_filters').addEventListener('change', function () {
            let search = this.value;
            getAjaxFilterCustomData('media_type', search);
        });
        document.querySelector('#album_id_filter').addEventListener('change', function () {
            let search = this.value;
            getAjaxFilterCustomData('album', search);
        });
        document.querySelector('#gallery_date').addEventListener('change', function () {
            let search = this.value;
            getAjaxFilterCustomData('date', search);
        });

        async function getMediaData() {
            let sendUrl = "{{route('get-ajax-gallery')}}";
            return await axios.get(sendUrl).then(function (response) {
                return response.data.galleryData;
            }).catch(function (error) {
                console.log(error);
            });

        }

        function filterData(id) {
            getMediaData().then(data => {
                let findData = data.filter(function (item) {
                    return item.id == id;
                });
                let fileData = findData.shift();
                customModelTemplates(fileData);
            }).catch(error => {
                console.log(error);
            });
        }

        function updateMediaData(id, data) {
            let sendUrl = "{{route('manage-media.update',':id')}}";
            sendUrl = sendUrl.replace(':id', id);
            return axios.put(sendUrl, data).then(function (response) {
                return response.data;
            })
                .catch(function (error) {
                    console.log(error);
                });
        }


        function customModelTemplates(fileData) {
            let editUrl = `{{ route('manage-media.edit', ':id') }}`;
            let editImageUrl = "{{ route('edit-image') }}"+'/'+fileData.id;
            editUrl = editUrl.replace(':id', fileData.id);
            let deleteById = `{{ route('media-delete-by-id') }}/${fileData.id}`;
            let outPut = `<div class="row">
                    <div class="col-md-8">
                    `;

            if (["image/jpeg", "image/png", "image/jpg"].includes(fileData.mime_type)) {
                outPut += `<img src="${fileData.url}" alt="" class="img-fluid" style="max-height: 500px;">
                    <hr>
                    <a href="${editImageUrl}" class="btn btn-primary btn-sm">Edit Image</a>
                    `;
            } else if (["video/mp4", "video/ogg", "video/webm"].includes(fileData.mime_type)) {
                outPut += `<video controls style="max-height: 500px;">
                <source src="${fileData.url}" type="${fileData.mime_type}">
                Your browser does not support the video tag.
                </video>`;
            } else if (["audio/mpeg", "audio/ogg", "audio/wav"].includes(fileData.mime_type)) {
                outPut += `<audio controls style="max-height: 500px;">
                <source src="${fileData.url}" type="${fileData.mime_type}">
                Your browser does not support the audio tag.
                </audio>`;
            } else if ([
                "application/pdf",
                "application/msword",
                "application/vnd.ms-excel",
                "application/vnd.ms-powerpoint",
                "application/zip",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation"
            ].includes(fileData.mime_type)) {
                outPut += `<img src="{{ url('icons/document.png') }}" alt="" style="text-align:center">`;
            } else {
                outPut += `<img src="{{ url('icons/default.png') }}" alt="" class="img-fluid" style="max-height: 500px;">`;
            }

            outPut += `</div>
          <div class="col-md-4">
            <p>Uploaded on: <strong>${fileData.created_at}</strong></p>
            <p>File name: <strong>${fileData.file_name}</strong></p>
            <p>File Type: <strong>${fileData.mime_type}</strong></p>
            <p>Dimensions: <strong>${fileData.dimensions}</strong></p>
            <div class="form-group mb-2">
              <label for="alternative_text">Alternative text</label>
              <input type="text" id="alternative_text"
                value="${fileData.alternative_text ? fileData.alternative_text : ''}"
                class="form-control form-control-sm">
            </div>
            <div class="form-group mb-2">
              <label for="title">Title</label>
              <input type="text" id="title"
                value="${fileData.title ? fileData.title : ''}"
                class="form-control form-control-sm">
            </div>
            <div class="form-group mb-3">
              <label for="caption">Caption</label>
              <input type="text" id="caption"
                value="${fileData.caption ? fileData.caption : ''}"
                class="form-control form-control-sm">
            </div>
            <div class="form-group mt-3">
              <label for="description">Description</label>
              <textarea id="description"
                class="form-control form-control-sm">${fileData.description ? fileData.description : ''}</textarea>
            </div>
            <div class="form-group mt-3">
              <label for="file_url">File Url</label>
              <input type="url" id="file_url"
                value="${fileData.url}"
                class="form-control form-control-sm">
            </div>
            <div class="form-group mt-3">
              <button class="btn btn-light btn-sm" id="copy_url_to_clipboard">Copy URL to clipboard</button>
              <div class="copy_message" style="color: green"></div>
            </div>
            <div class="form-group mt-3">
              <hr>
              <a href="${editUrl}">Edit more details</a> | <a href="${fileData.url}" download>Download file</a> | <a href="${deleteById}" onclick="return confirm('Are you sure?')" style="color: red;">Delete permanently</a>
            </div>
          </div>
        </div>`;

            document.getElementById('resultBox').innerHTML = outPut;
            document.querySelector('#title').addEventListener('keyup', function () {
                let title = this.value;
                let data = {
                    title: title
                };
                updateMediaData(fileData.id, data).then(data => {
                });
            });
            document.querySelector('#alternative_text').addEventListener('keyup', function () {
                let alternative_text = this.value;
                let data = {
                    alternative_text: alternative_text
                };
                updateMediaData(fileData.id, data).then(data => {
                });
            });
            document.querySelector('#caption').addEventListener('keyup', function () {
                let caption = this.value;
                let data = {
                    caption: caption
                };
                updateMediaData(fileData.id, data).then(data => {
                });
            });
            document.querySelector('#description').addEventListener('keyup', function () {
                let description = this.value;
                let data = {
                    description: description
                };
                updateMediaData(fileData.id, data).then(data => {
                });
            });
            document.querySelector('#copy_url_to_clipboard').addEventListener('click', function () {
                let file_url = document.querySelector('#file_url');
                file_url.select();
                file_url.setSelectionRange(0, 99999);
                document.execCommand("copy");
                document.querySelector('.copy_message').innerHTML = 'Copied the text: ' + file_url.value;
            });
        }


        let allImages = document.querySelectorAll('.dp-select-image');
        let allFileId = Array.from(allImages, item => item.querySelector('.image-ids').value);
        let currentIndex = 0;

        const previous = document.getElementById('previous');
        const next = document.getElementById('next');
        const myModel = document.getElementById('myModelBox');


        function updateButtonVisibility() {
            if (currentIndex === 0) {
                previous.disabled = true;
            } else {
                previous.disabled = false;
                next.disabled = currentIndex === allFileId.length - 1;
            }

        }

        previous.addEventListener('click', function () {
            if (currentIndex > 0) {
                currentIndex--;
                filterData(allFileId[currentIndex]);
                updateButtonVisibility();
            }
        });

        next.addEventListener('click', function () {
            if (currentIndex < allFileId.length - 1) {
                currentIndex++;
                filterData(allFileId[currentIndex]);
                updateButtonVisibility();
            }
        });

        function customModelOpenAndHide(event) {
            let id = event.querySelector('.image-ids').value;
            currentIndex = allFileId.indexOf(id);
            updateButtonVisibility();
            filterData(id);
            myModel.style.display = 'block';
        }

        let mediaCloseBox = document.getElementById('mediaCloseBox');
        mediaCloseBox.addEventListener('click', function () {
            let myModel = document.getElementById('myModelBox');
            myModel.style.display = 'none';
            document.getElementById('resultBox').innerHTML = '';
        });


    </script>

@endsection
