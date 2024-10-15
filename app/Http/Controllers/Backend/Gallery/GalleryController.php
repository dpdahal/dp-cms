<?php

namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Repositories\Gallery\GalleryInterface;
use Illuminate\Http\Request;

class GalleryController extends BackendController
{
    protected GalleryInterface $gi;

    public function __construct(GalleryInterface $gi)
    {
        parent::__construct();
        $this->gi = $gi;
    }

    public function index(Request $request)
    {
        $mode = $request->mode;
        if ($mode == 'list') {
            $this->data('gallery', $this->gi->listMode($request));
            return view('backend.pages.media.media-list', $this->data);
        } else {
            $gallery = $this->gi->index();
            $this->data('gallery', $gallery);
            return view('backend.pages.media.index', $this->data);
        }
    }

    public function create()
    {
        return view('backend.pages.media.create', $this->data);
    }


    public function store(Request $request)
    {
        $gallery = $this->gi->insert($request);
        return response()->json(['galleryData' => $gallery], 200);
    }


    public function addMediaFile(Request $request)
    {
        if ($request->isMethod('get')) {
            $this->data('albumsData', $this->gi->getAlbum());
            return view('backend.pages.media.add-media-file', $this->data);
        } else {
            $this->validate($request, [
                'album_id' => 'required',
                'file' => 'required',
            ]);
            $this->gi->addByForm($request);
            return redirect()->back()->with('success', 'Data is successfully added');
        }
    }


    public function show($id)
    {
        $sendData = $this->gi->view($id);
        return response()->json($sendData);
    }

    public function edit($id)
    {
        $this->data('albumsData', $this->gi->getAlbum());
        $this->data('gallery', $this->gi->getById($id));
        return view('backend.pages.media.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $this->gi->update($request, $id);
        if ($request->update_by_normal_form) {
            return redirect()->back()->with('success', 'Data is successfully updated');
        } else {
            return response()->json(['success' => 'Data is successfully updated']);
        }
    }

    public function destroy($id)
    {
        $this->gi->deleteData($id);
        return redirect()->back()->with('success', 'Data is successfully deleted');
    }

    public function mediaDeleteById($id)
    {
        $this->gi->mediaDeleteById($id);
        return redirect()->route('manage-media.index')->with('success', 'Data is successfully deleted');
    }

    public function deleteAll(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->back();
        }
        $ids = $request->checkbox;
        if (empty($ids)) {
            return redirect()->back()->with('error', 'please select any data');
        } else {
            $this->gi->deleteAllMedia($ids);
            return redirect()->back()->with('success', 'Data is successfully deleted');
        }
    }


    public function editImage(Request $request)
    {
        if ($request->isMethod('get')) {
            $this->data('galleryData', $this->gi->getById($request->id));
            return view('backend.pages.media.edit-image', $this->data);
        }
        $this->gi->editImageFile($request, $request->id);
        return response()->json(['galleryData' => 'data was edited'], 200);
    }


    public function restoreImage(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->gi->restoreMedia($request->id);
            return redirect()->back();
        }
        return redirect()->back();
    }


}
