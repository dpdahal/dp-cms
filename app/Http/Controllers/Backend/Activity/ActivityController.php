<?php

namespace App\Http\Controllers\Backend\Activity;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends BackendController
{

    public function index(Request $request)
    {
        $this->checkAuthorization($request->user(), 'activity_log_list');
        $this->data('activityData', Activity::all());
        return view($this->pagePath . 'activity.index', $this->data);
    }

    public function create()
    {

        return view('backend.activity.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('backend.activity.show');
    }

    public function edit($id)
    {
        return view('backend.activity.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
