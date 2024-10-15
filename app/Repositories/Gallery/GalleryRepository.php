<?php

namespace App\Repositories\Gallery;

use App\Models\Gallery\Album;
use App\Models\Gallery\Gallery;
use App\Models\Gallery\GallerySetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class GalleryRepository implements GalleryInterface
{

    protected Gallery $gallery;

    public function __construct(Gallery $model)
    {
        $this->gallery = $model;
    }

    public function mediaTypeFilter($type)
    {
        if ($type == 'image') {
            $types = ['image/jpeg', 'image/png', 'image/gif'];
            return $this->gallery->whereIn('mime_type', $types)->get();
        } else if ($type == 'video') {
            $types = ['video/mp4', 'video/ogg', 'video/webm'];
            return $this->gallery->whereIn('mime_type', $types)->get();
        } else if ($type == 'audio') {
            $types = ['audio/mpeg', 'audio/ogg', 'audio/wav'];
            return $this->gallery->whereIn('mime_type', $types)->get();
        } else if ($type == 'document') {
            $types = [
                'application/pdf',
                'application/msword',
                'application/vnd.ms-excel',
                'application/vnd.ms-powerpoint',
                'application/zip',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'application/vnd.oasis.opendocument.text',
                'application/vnd.oasis.opendocument.spreadsheet',
                'application/vnd.oasis.opendocument.presentation',
            ];
            $this->gallery->whereIn('mime_type', $types)->get();
        } else if ($type == 'other') {
            $types = ['application/octet-stream', 'application/x-rar-compressed', 'application/x-tar', 'application/x-7z-compressed'];
            return $this->gallery->whereIn('mime_type', $types)->get();
        }
        return $this->gallery->get();

    }

    public function listMode($request)
    {
        $search = $request->search;
        $album_id = $request->album_id;
        $gallery_date = $request->gallery_date;
        $media_type = $request->media_types;
        if ($search) {
            return $this->gallery->where('title', 'LIKE', '%' . $search . '%')->get();
        } else if ($album_id) {
            return $this->gallery->where('album_id', $album_id)->get();
        } else if ($gallery_date) {
            return $this->gallery->whereMonth('created_at', date('m', strtotime($gallery_date)))
                ->whereYear('created_at', date('Y', strtotime($gallery_date)))
                ->get();
        } else {
            return $this->mediaTypeFilter($media_type);
        }
    }

    public function index()
    {
        return $this->gallery->get();
    }

    public function insert($request)
    {
        $data = $this->singleFileUpload();
        $insertData['album_id'] = $request->album_id;
        $insertData['file_name'] = $data['file_name'];
        $insertData['mime_type'] = $data['mime_type'];
        $insertData['url'] = $data['url'];
        $insertData['post_author'] = auth()->user()->id;
        return $this->gallery->create($insertData);
    }

    public function addByForm($request)
    {
        $data = $this->singleFileUpload();
        $insertData['album_id'] = $request->album_id;
        $insertData['file_name'] = $data['file_name'];
        $insertData['mime_type'] = $data['mime_type'];
        $insertData['url'] = $data['url'];
        $insertData['post_author'] = auth()->user()->id;
        return $this->gallery->create($insertData);
    }


    public function getById($id)
    {
        return $this->gallery->findOrFail($id);
    }

    public function getAlbum()
    {
        return Album::all();
    }

    public function update($request, $id)
    {
        $gallery = $this->gallery->findOrFail($id);
        if ($request->has('alternative_text')) {
            $gallery->alternative_text = $request->alternative_text;
        }
        if ($request->has('title')) {
            $gallery->title = $request->title;
        }
        if ($request->has('caption')) {
            $gallery->caption = $request->caption;
        }
        if ($request->has('description')) {
            $gallery->description = $request->description;
        }
        if ($request->has('album_id')) {
            $gallery->album_id = $request->album_id;
        }
        return $gallery->save();
    }


    public function restoreMedia($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $gallery->edit_url = null;
        $gallery->save();
        return true;
    }

    public function view($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $image = public_path($gallery->url);
        list($width, $height) = getimagesize($image);
        $gallery['width'] = $width;
        $gallery['height'] = $height;
        $gallery['url'] = url($gallery->url);
        $allGallery = $this->gallery->get();
        $sendData = [
            'gallery' => $gallery,
            'allGallery' => $allGallery,
            'allCategory' => $this->getAlbum(),
        ];
        return $sendData;
    }


    public function deleteData($id)
    {
        if ($this->deleteEditFileNameIfExists($id) && $this->deleteOriginalFile($id)) {
            $this->gallery->findOrFail($id)->delete();
            return true;
        } else {
            return false;
        }

    }

    private function deleteOriginalFile($id)
    {
        $filePath = $this->getFilePathName($id);
        $gallery = $this->gallery->findOrFail($id);
        $fileName = $gallery->file_name;
        $deletePath = $filePath . $fileName;
        return $this->filePathDelete($deletePath);
    }

    public function editImageFile($request, $id)
    {
        $filePath = $this->filePath($request->id);
        $editName = $this->editFileName($request->id);
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_base64 = base64_decode($image_parts[1]);
        $imageFullPath = $filePath . '/' . $editName;
        file_put_contents($imageFullPath, $image_base64);
        $gallery = $this->gallery->findOrFail($id);
        $gallery->edit_url = url($imageFullPath);
        $gallery->save();
        return true;
    }

    private function editFileName($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $fileName = $gallery->file_name;
        return $this->addELetterToFilename($fileName);

    }

    private function addELetterToFilename($filename): string
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        $uid = uniqid();
        return $filenameWithoutExtension . '-e' . $uid . '.' . $extension;
    }

    private function filePath($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $url = $gallery->url;
        $path = explode('/', $url);
        $path = array_filter($path);
        $postDate = $gallery->post_date;
        $year = date('Y', strtotime($postDate));
        $month = date('m', strtotime($postDate));
        if (count($path) > 4) {
            $filePath = 'uploads/' . $year . '/' . $month;
        } else {
            $filePath = 'uploads/';
        }
        return $filePath;
    }


    private function deleteEditFileNameIfExists($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $fileName = $gallery->file_name;
        $filePath = $this->getFilePathName($id);
        $files = File::allFiles($filePath);
        $originalFileName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
        $allFileName = [];
        foreach ($files as $file) {
            $allFileName[] = $file->getFilename();
        }
        $checkFileName = preg_grep('/^' . $originalFileName . '-e/', $allFileName);
        if (count($checkFileName) > 0) {
            foreach ($checkFileName as $file) {
                $this->filePathDelete($filePath . $file);
            }

        }
        return true;
    }

    private function getFilePathName($id)
    {
        $gallery = $this->gallery->findOrFail($id);
        $postDate = $gallery->post_date;
        $year = date('Y', strtotime($postDate));
        $month = date('m', strtotime($postDate));
        $fileName = $gallery->file_name;
        $filePath = 'uploads/' . $year . '/' . $month . '/' . $fileName;
        if (!File::exists($filePath)) {
            return 'uploads/';
        } else {
            return 'uploads/' . $year . '/' . $month . '/';
        }
    }


    private function filePathDelete($path)
    {
        if (file_exists($path) && is_file($path)) {
            unlink($path);
            return true;
        }
        return true;
    }

    public function deleteAllMedia($ids)
    {
        foreach ($ids as $id) {
            $this->deleteData($id);
        }
        return true;
    }

    public function mediaDeleteById($criteria)
    {
        $this->deleteData($criteria);
        return true;
    }

    private function isUploadTo()
    {
        $gallerySettings = GallerySetting::select('upload_to')->first();
        $uploadTo = $gallerySettings->upload_to;
        if ($uploadTo == 1) {
            return true;
        } else {
            return false;
        }
    }


    public function singleFileUpload()
    {
        if (!empty(Request::file())) {
            if ($this->isUploadTo()) {
                $year = date('Y');
                $month = date('m');
                $dateFolder = $year . '/' . $month;
                $directoryPath = trim('uploads/' . $dateFolder);
                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0755, true);
                }
                $uploadPath = $directoryPath;
            } else {
                $uploadPath = 'uploads';
            }

            $file = Request::file();
            $file = Arr::first($file);
            $name = $file->getClientOriginalName();
            $x = uniqid();
            if (File::exists($uploadPath . '/' . $name)) {
                $name = $this->addSuffixToFilename($name, $x);
            }
            $file->move($uploadPath, $name);
            $url = $uploadPath . '/' . $name;
            return [
                'file_name' => $name,
                'url' => url($url),
                'mime_type' => $file->getClientMimeType(),
            ];
        }

        return false;
    }

    private function addSuffixToFilename($filename, $suffix): string
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
        return $filenameWithoutExtension . '-' . $suffix . '.' . $extension;
    }

}
