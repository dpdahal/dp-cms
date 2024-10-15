@extends('frontend.app')
@section('content')
    <div class="container mt-3 mb-5">
        <div class="row">
            <div class="col-md-9">
                <h1>{{$blogData->title}}</h1>
                @if($blogData->image)
                    <img src="{{url($blogData->image)}}" alt="">
                @endif
                <p>{!! $blogData->description !!}</p>

                <hr>

                @foreach($blogData->getPostInnerPage as $page)
                    <h1>{{$page->title}}</h1>
                    <p>
                        {!! $page->description !!}
                    </p>
                @endforeach


                <div class="col-md-12">

                    <h4>Add comment</h4>
                    <form method="post" action="{{ route('blog-comment')}}">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="body"></textarea>
                            <input type="hidden" name="blog_id" value="{{ $blogData->id }}"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Add Comment"/>
                        </div>
                    </form>
                    @include('frontend.blog.blog-comment', ['comments' => $blogData->comments, 'blog_id' => $blogData->id])


                </div>
            </div>
        </div>
    </div>

@endsection
