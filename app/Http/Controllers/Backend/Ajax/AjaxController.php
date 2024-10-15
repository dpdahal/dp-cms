<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Destination\Destination;
use App\Models\Gallery\Album;
use App\Models\Gallery\Gallery;
use App\Models\Posts\Category;
use App\Models\Tour\Itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


class AjaxController extends Controller
{

    public function loadNestedRelationship($category)
    {
        $category->load('children');
        if ($category->children) {
            foreach ($category->children as $child) {
                $this->loadNestedRelationship($child);
            }
        }
    }

    public function getAjaxDestination()
    {
        $destinationData = Destination::where('parent_id', null)->orderBy('id', 'desc')->get();;
        $destinationData->each(function ($destination) {
            $this->loadNestedRelationship($destination);
        });
        return response()->json(['destinationData' => $destinationData]);
    }

    public function setAjaxDestination(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|integer',
            ]);
            $validatedData['slug'] = Str::slug($request->name);
            $insertData = Destination::create($validatedData);
            return response()->json(['destinationData' => $insertData], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422); // 422 is the status code for unprocessable entity (validation error)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create destination'], 500); // 500 is the status code for internal server error
        }
    }


    public function getAjaxCategory()
    {
        $categoryData = Category::where('parent_id', null)->orderBy('id', 'desc')->get();;
        $categoryData->each(function ($category) {
            $this->loadNestedRelationship($category);
        });
        return response()->json(['categoryData' => $categoryData]);
    }

    public function setAjaxCategory(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'parent_id' => 'nullable|integer',
            ]);
            $validatedData['slug'] = Str::slug($request->name);
            $insertData = Category::create($validatedData);
            return response()->json(['categoryData' => $insertData], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422); // 422 is the status code for unprocessable entity (validation error)
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create category'], 500); // 500 is the status code for internal server error
        }
    }


    public function getAjaxAlbum(Request $request)
    {
        $orderType = $request->order_type ?? 'asc';
        $albumData = Album::orderBy('id', $orderType)->get();
        return response()->json(['albumData' => $albumData]);
    }

    public function setAjaxAlbum(Request $request)
    {
        $albumName = $request->album_name;
        $exists = Album::where('name', '=', $albumName)->first();
        if (!$exists) {
            $album = new Album();
            $album->name = $albumName;
            $album->save();
            return response()->json(['success' => 'success'], 200);
        } else {
            return response()->json(['error' => 'Album already exists'], 200);
        }

    }


    function getAjaxGallery()
    {
        $galleryData = Gallery::all();
        return response()->json(['galleryData' => $galleryData]);
    }

    public function getOnlyImage()
    {
        $types = ['image/jpeg', 'image/png', 'image/gif'];
        $gallery = Gallery::whereIn('mime_type', $types)->get();
        return response()->json(['galleryData' => $gallery]);
    }

    public function printGalleryData($gallery, $type = null)
    {
        if ($gallery->count() == 0) {
            $url = route('manage-media.index') . '?mode=grid';
            return '<div class="row"><div class="col-md-12"><h1>No data found</h1> <a href="' . $url . '">Refresh Page</a></div></div>';

        }
        $outPutData = '<div class="row">';
        foreach ($gallery as $image) {
            $outPutData .= '<div class="dp-select-image col-md-2 mb-3" style="cursor: pointer;" onclick="customModelOpenAndHide(this);">';
            $outPutData .= '<input type="hidden" class="image-ids" value="' . $image->id . '">';

            if (in_array($image->mime_type, ['image/jpeg', 'image/png', 'image/jpg'])) {
                $outPutData .= '<img src="' . url($image->url) . '" alt="" class="img-fluid" style="width: 100%; height: 129px">';
            } elseif (in_array($image->mime_type, ['video/mp4', 'video/ogg', 'video/webm'])) {
                $outPutData .= '<div class="mediaBox">';
                $outPutData .= '<img src="' . url('icons/video.png') . '" alt="">';
                $outPutData .= '<div class="mediaNameBox">';
                $outPutData .= '<p>' . $image->file_name . '</p>';
                $outPutData .= '</div>';
                $outPutData .= '</div>';
            } elseif (in_array($image->mime_type, ['audio/mpeg', 'audio/ogg', 'audio/wav'])) {
                $outPutData .= '<div class="mediaBox">';
                $outPutData .= '<img src="' . url('icons/audio.png') . '" alt="">';
                $outPutData .= '<div class="mediaNameBox">';
                $outPutData .= '<p>' . $image->file_name . '</p>';
                $outPutData .= '</div>';
                $outPutData .= '</div>';
            } elseif (in_array($image->mime_type, ['application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/zip', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])) {
                $outPutData .= '<div class="mediaBox">';
                $outPutData .= '<img src="' . url('icons/document.png') . '" alt="">';
                $outPutData .= '<div class="mediaNameBox">';
                $outPutData .= '<p>' . $image->file_name . '</p>';
                $outPutData .= '</div>';
                $outPutData .= '</div>';
            } else {
                $outPutData .= '<div class="mediaBox">';
                $outPutData .= '<img src="' . url('icons/default.png') . '" alt="">';
                $outPutData .= '<div class="mediaNameBox">';
                $outPutData .= '<p>' . $image->file_name . '</p>';
                $outPutData .= '</div>';
                $outPutData .= '</div>';
            }

            $outPutData .= '</div>';
        }
        $outPutData .= '</div>';
        return $outPutData;

    }

    public function mediaTypeFilter($type)
    {
        if ($type == 'image') {
            $types = ['image/jpeg', 'image/png', 'image/gif'];
            return Gallery::whereIn('mime_type', $types)->get();
        }
        if ($type == 'video') {
            $types = ['video/mp4', 'video/ogg', 'video/webm'];
            return Gallery::whereIn('mime_type', $types)->get();
        }
        if ($type == 'audio') {
            $types = ['audio/mpeg', 'audio/ogg', 'audio/wav'];
            return Gallery::whereIn('mime_type', $types)->get();
        }
        if ($type == 'document') {
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
            return Gallery::whereIn('mime_type', $types)->get();
        }
        if ($type == 'other') {
            $types = ['application/octet-stream', 'application/x-rar-compressed', 'application/x-tar', 'application/x-7z-compressed'];
            return Gallery::whereIn('mime_type', $types)->get();
        } else {
            return Gallery::all();
        }

    }

    public function getSearchImage(Request $request)
    {

        $requestType = $request->type;
        $criteria = $request->value;

        if ($requestType == 'search') {
            $gallery = Gallery::where('title', 'LIKE', '%' . $criteria . '%')->get();
            return response()->json(['galleryData' => $this->printGalleryData($gallery)]);
        }
        if ($requestType == 'album') {
            $gallery = Gallery::where('album_id', $criteria)->get();
            return response()->json(['galleryData' => $this->printGalleryData($gallery)]);
        }
        if ($requestType == 'date') {
            $gallery = Gallery::whereMonth('created_at', date('m', strtotime($criteria)))
                ->whereYear('created_at', date('Y', strtotime($criteria)))
                ->get();
            return response()->json(['galleryData' => $this->printGalleryData($gallery)]);
        }
        if ($requestType == 'media_type') {
            $gallery = $this->mediaTypeFilter($criteria);
            return response()->json(['galleryData' => $this->printGalleryData($gallery)]);
        }
        return response()->json(['galleryData' => $this->printGalleryData(Gallery::all())]);

    }

    public function getItinerary(Request $request)
    {
        $itineraryData = Itinerary::all();
        return response()->json(['itineraryData' => $itineraryData]);
    }


}
