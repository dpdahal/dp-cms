<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner\Banner;
use App\Models\Blog\Blog;
use App\Models\Faq\Faq;
use App\Models\Job\JobApply;
use App\Models\Job\JobPage;
use App\Models\Page\Menu;
use App\Models\Page\Page;
use App\Models\Resume\Resume;
use App\Models\Team\Team;
use App\Models\Testimonial\Testimonial;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;


class ApplicationController extends Controller
{

    public function index()
    {
        SEOMeta::setTitle('Home');
        $this->data('bannerData', Banner::all());
        $this->data('homeBlogData', Blog::orderBy('id', 'desc')->limit(3)->get());
        $this->data('testimonialData', Testimonial::all());
        $this->data('outTeamData', Team::all());
        return view('frontend.home', $this->data);
    }


    public function faq()
    {
        $this->data('faqData', Faq::all());
        return view('frontend.faq.index', $this->data);
    }


    public function allData(Request $request)
    {
        $uri = \Request::getRequestUri();
        $uri = trim($uri, '/');
        $convertUrl = explode('/', $uri);
        $slug = $convertUrl[0];
        $menuData = Menu::where('slug', '=', $slug)->first();
        if ($menuData->slug == 'about-us') {
            if (count($convertUrl) > 1) {
                $pageData = Page::where('slug', '=', $convertUrl[1])->first();
                $this->data('pageData', $pageData);
                $relatedService = Page::where('menu_id', '=', $menuData->id)
                    ->where('id', '!=', $pageData->id)
                    ->get();
                $this->data('relatedPage', $relatedService);
                $this->data('menuData', $menuData);
                SEOMeta::setTitle($pageData->title);
                SEOMeta::setDescription($pageData->meta_description);
                return view('frontend.about.details', $this->data);
            } else {

                SEOMeta::setTitle('About Us');
                $this->data('menuData', $menuData);
                return view('frontend.about.index', $this->data);
            }
        }
        if (count($convertUrl) > 1) {
            $pageData = Page::where('slug', '=', $convertUrl[1])->first();
            $this->data('pageData', $pageData);
            $relatedService = Page::where('menu_id', '=', $menuData->id)
                ->where('id', '!=', $pageData->id)
                ->get();
            $this->data('relatedPage', $relatedService);
            $this->data('menuData', $menuData);
            SEOMeta::setTitle($pageData->title);
            SEOMeta::setDescription($pageData->meta_description);

            return view('frontend.page.page-details', $this->data);
        } else {
            $this->data('menuData', $menuData);
            SEOMeta::setTitle($menuData->name);
            return view('frontend.page.index', $this->data);
        }

    }

    public function banner(Request $request)
    {
        if (empty($request->slug)) {
            return redirect()->route('index');
        }
        $bannerData = Banner::where('slug', '=', $request->slug)->first();
        if (empty($bannerData)) {
            return redirect()->route('index');
        }
        SEOMeta::setTitle($bannerData->title);
        $relatedBanner = Banner::where('id', '!=', $bannerData->id)->get();
        $this->data('relatedBanner', $relatedBanner);
        $this->data('banner', $bannerData);
        return view('frontend.banner.index', $this->data);

    }

    public function job(Request $request)
    {
        if (!empty($request->slug)) {
            $this->data('jobData', JobPage::where('slug', '=', $request->slug)->first());
            SEOMeta::setTitle($this->data['jobData']->title);
            return view('frontend.jobs.details', $this->data);
        } else {
            $this->data('jobsData', JobPage::all());
            SEOMeta::setTitle('Jobs');
            return view('frontend.jobs.index', $this->data);
        }
    }

    public function upload_resume(Request $request)
    {
        if ($request->isMethod('get')) {
            SEOMeta::setTitle('Upload Resume');
            return view('frontend.resume.index');
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'resume' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
            ]);

            $data = $request->all();
            $data['resume'] = $this->customFileUpload('uploads/resume');
            Resume::create($data);
            return redirect()->back()->with('success', 'Resume uploaded successfully');
        }
    }

    public function apply(Request $request)
    {
        if (!auth()->check()) {
            session(['last_product_page_id' => url()->previous()]);
            return redirect()->route('login');
        }
        $jobData = JobPage::where('slug', '=', $request->slug)->first();
        if (empty($jobData)) {
            return redirect()->route('index');
        }
        if ($request->isMethod('POST')) {

//            $request->validate([
//                'resume' => 'required|mimes:pdf,doc,docx,jpg,jpeg,png,gif',
//            ]);
            $data = $request->all();
            $data['job_id'] = (int)$jobData->id;
            $data['user_id'] = (int)auth()->id();
            $data['resume'] = $this->customFileUpload('uploads/resume');
            $data['status'] = 'applied';
            JobApply::create($data);
            return redirect()->back()->with('success', 'Job applied successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

}
