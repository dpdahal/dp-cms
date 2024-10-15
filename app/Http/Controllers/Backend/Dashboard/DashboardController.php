<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Backend\Common\BackendController;
use App\Models\Contact\Contact;
use App\Models\Resume\Resume;
use App\Models\User\AccountType;
use Illuminate\Http\Request;

class DashboardController extends BackendController
{

    public function index()
    {
        $this->data('accountTypes', AccountType::all());
        return view($this->pagePath . 'dashboard.index', $this->data);
    }

    public function contact(Request $request)
    {
        $this->checkAuthorization($request->user(), 'contacts_list');
        $this->data('contactData', Contact::orderBy('id', 'desc')->get());
        return view($this->pagePath . 'contact.index', $this->data);

    }

    public function resume_list(Request $request)
    {
        $this->checkAuthorization($request->user(), 'resumes_list');
        $this->data('resumeData', Resume::orderBy('id', 'desc')->get());
        return view($this->pagePath . 'resume.index', $this->data);

    }

    public function deleteContact(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'contacts_delete');
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->back()->with('success', 'Contact Deleted Successfully');
    }

    public function deleteResume(Request $request, $id)
    {
        $this->checkAuthorization($request->user(), 'resumes_delete');
        $resume = Resume::find($id);
        $fileFilePath = public_path($resume->resume);
        if (file_exists($fileFilePath) && is_file($fileFilePath)) {
            unlink($fileFilePath);
        }
        $resume->delete();
        return redirect()->back()->with('success', 'Resume Deleted Successfully');
    }
}
