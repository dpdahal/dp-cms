<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogComments;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        if (!empty($request->slug)) {
            $this->data('blogData', Blog::where('slug', '=', $request->slug)->first());
            SEOMeta::setTitle($this->data['blogData']->title);
            return view('frontend.blog.details', $this->data);
        } else {
            $this->data('allBlogData', Blog::all());
            SEOMeta::setTitle('Blog');
            return view('frontend.blog.index', $this->data);
        }
    }

    public function blogComment(Request $request)
    {


        if (!Auth::check()) {
            session(['last_product_page_id' => url()->previous()]);
            return redirect()->route('auth');
        }

        if ($request->isMethod('get')) {
            return redirect()->back();
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'body' => 'required',
            ]);

            $input = $request->all();
            $input['user_id'] = Auth::user()->id;
            BlogComments::create($input);
            return back();

        }

    }
}
