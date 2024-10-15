<?php

namespace App\Repositories\Album;

interface AlbumInterface
{
    public function all();

    public function store($data);

    public function show($id);

    public function update($data, $id);

    public function delete($id);

}
