<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait General
{
    public $data = [];

    public function __construct()
    {
        $this->data('title', $this->makeTitle());

    }

    public function makeTitle(): string
    {
        $serverName = env('APP_NAME');
        $path = Request::path();
        if ($path == '/') {
            $path = $serverName;
        }
        return str_replace('/', ' | ', $path);

    }


    public function data($key, $value = '')
    {
        return $this->data[$key] = $value;
    }

    public function make_slug($string)
    {
        return Str::slug($string);
    }

    public function customFileUpload($directionPath = '')
    {
        if (!empty(Request::file())) {
            $directionPath = trim($directionPath, '/');
            $files = Request::file();
            $file = Arr::first($files);
            $ext = $file->getClientOriginalExtension();
            $imageName = md5(microtime()) . '.' . Str::lower($ext);
            $directionPath = trim($directionPath, '/');
            $uploadPath = public_path($directionPath);
            if (!File::exists($uploadPath)) {
                File::makeDirectory($directionPath, 0755, true);
            }
            $file->move($uploadPath, $imageName);
            return $directionPath . '/' . $imageName;
        }
        return "";
    }

    public function deleteFile($filePath)
    {
        $getFilePath = public_path($filePath);
        if (file_exists($getFilePath) && is_file($getFilePath)) {
            unlink($filePath);
            return true;
        }
        return true;
    }

    public function uploadMultipleFile($files, $directionPath = '')
    {
        $directionPath = trim($directionPath, '/');
        $uploadPath = public_path($directionPath);
        if (!File::exists($uploadPath)) {
            File::makeDirectory($directionPath, 0755, true);
        }
        $fileNames = [];
        foreach ($files as $file) {
            $ext = $file->getClientOriginalExtension();
            $imageName = md5(microtime()) . '.' . Str::lower($ext);
            $file->move($uploadPath, $imageName);
            $fileNames[] = $directionPath . '/' . $imageName;
        }
        return $fileNames;
    }


}
