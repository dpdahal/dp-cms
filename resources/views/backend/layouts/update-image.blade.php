<style>
    .custom-container {
        border: 1px solid #ccc;
        padding: 5px;
    }

    .show_image img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .custom-file-input {
        display: inline-block;
        position: relative;
    }

    .custom-file-input input[type="file"] {
        position: absolute;
        left: -9999px;
    }

    .custom-file-input label {
        display: inline-block;
        padding: 8px 12px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
    }

    .file-name {
        margin-left: 10px;
    }

</style>
<div class="custom-container">
    <div class="show_image mb-3"></div>
    <div class="row">
        <div class="col-md-3">
            <div class="btn btn-danger btn-sm mt-1" title="Delete Image" onclick="deleteFile();">
                <i class="bi bi-trash-fill"></i>
            </div>
        </div>
        <div class="col-md-9">
            <div class="custom-file-input float-end">
                <input type="file" id="upload_file" class="form-control mb-2 float-end">
                <label for="upload_file">
                    <i class="bi bi-image-fill"></i> Update</label>
                <span class="file-name"></span>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        function getFile() {
            let tableName = '{{ $tableName }}';
            let id = '{{ $id }}';
            let columnName = '{{ $columnName ?? "image" }}';

            let sendData = {
                tableName: tableName,
                columnName: columnName,
                id: id,
                type: 'get_file'
            };

            axios.post('{{ route('ajax-file-manage') }}', sendData)
                .then(function (response) {
                    let data = response.data.data;
                    let imagePath = `<img src='${data[columnName]}' style="height: 200px;">`;
                    let show_box = document.querySelector('.show_image');
                    show_box.innerHTML = imagePath;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

        getFile();

        function deleteFile() {
            let tableName = '{{ $tableName }}';
            let columnName = '{{ $columnName ?? "image" }}';
            let id = '{{ $id }}';
            let sendData = {
                tableName: tableName,
                columnName: columnName,
                id: id,
                type: 'delete_file'
            }
            axios.post('{{route('ajax-file-manage')}}', sendData)
                .then(function (response) {
                    getFile();

                })
                .catch(function (error) {
                    console.log(error);
                });
        }


        document.getElementById('upload_file').addEventListener('change', function () {
            let file = this.files[0];
            let tableName = '{{ $tableName }}';
            let id = '{{ $id }}';
            let columnName = '{{$columnName}}' ?? 'image';
            let formData = new FormData();
            formData.append('file', file);
            formData.append('tableName', tableName);
            formData.append('columnName', columnName);
            formData.append('id', id);
            formData.append('type', 'upload_file');
            axios.post('{{route('ajax-file-manage')}}', formData)
                .then(function (response) {
                    getFile();
                })
                .catch(function (error) {
                    console.log(error);
                });
        });

        $(document).ready(function () {

            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });

    </script>
@endsection
