<?php

namespace App\Repositories\Gallery;

interface GalleryInterface
{

    public function mediaTypeFilter($type);

    public function listMode($request);

    public function index();

    public function insert($request);

    public function addByForm($request);

    public function getById($id);

    public function view($id);

    public function getAlbum();

    public function update($request, $id);

    public function deleteData($id);

    public function restoreMedia($id);

    public function editImageFile($request, $id);

    public function deleteAllMedia($ids);

    public function mediaDeleteById($criteria);


}
