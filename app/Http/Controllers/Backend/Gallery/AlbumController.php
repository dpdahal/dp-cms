<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Requests\Gallery\AlbumCreateRequest;
use App\Repositories\Album\AlbumInterface;
use Illuminate\Http\Request;

class AlbumController extends BackendController
{
    protected $eI;

    function __construct(AlbumInterface $eI)
    {
        parent::__construct();
        $this->eI = $eI;
    }

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'albums_list');
        return view($this->pagePath . 'album.index');
    }


    public function allEducation(Request $request)
    {
        $this->checkAuthorization($request->user(), 'albums_list');
        $sectionData = $this->eI->all();
        return response()->json($sectionData);
    }

    public function store(AlbumCreateRequest $request)
    {
        $this->checkAuthorization($request->user(), 'albums_create');
        $this->eI->store($request->all());
        return response()->json(['success' => 'Album created successfully']);
    }

    public function delete(Request $request)
    {
        $this->checkAuthorization($request->user(), 'albums_delete');
        $response = $this->eI->delete($request->id);
        if (!$response) {
            return response()->json(['error' => 'Album is already in use']);
        } else {
            return response()->json(['success' => 'Album deleted successfully']);
        }

    }

    public function edit(Request $request)
    {
        $this->checkAuthorization($request->user(), 'albums_edit');
        $sectionData = $this->eI->show($request->id);
        return response()->json($sectionData);
    }

    public function update(Request $request)
    {
        $this->checkAuthorization($request->user(), 'albums_edit');
        $request->validate([
            'name' => 'required|unique:albums,name,' . $request->id,
        ]);
        $this->eI->update($request->all(), $request->id);
        return response()->json(['success' => 'Album updated successfully']);
    }
}
