@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="card">
                <div class="card-body mb-3 mt-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="font-size: 18px;"><i class="bi bi-image"></i> Media Gallery
                                    <a href="{{route('manage-media.create')}}"
                                       class="pull-right btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Add Media Files
                                    </a>
                                </h3>
                                <hr>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-1">
                                        <h1 style="font-size: 20px;">
                                            <a href="{{route('manage-media.index')."?mode=list"}}"
                                               style="text-decoration: none;color: black;"><i
                                                    class="bi bi-list"></i></a>
                                            <a href="{{route('manage-media.index')."?mode=gird"}}"
                                               style="text-decoration: none;color: black;"><i
                                                    class="bi bi-grid-fill"></i></a>
                                        </h1>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="row">
                                            @if(empty($_GET['mode']) || $_GET['mode']!='list')
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select name="media_types"
                                                                            id="media_attachment_filters"
                                                                            class="attachment-filters form-control form-control-sm">
                                                                        <option value="all">All media items</option>
                                                                        <option value="image">Images</option>
                                                                        <option value="audio">Audio</option>
                                                                        <option value="video">Video</option>
                                                                        <option value="document">Documents</option>
                                                                        <option value="other">Other</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-control form-control-sm"
                                                                            id="album_id_filter" name="album_id">
                                                                        <option value="">Select Album</option>
                                                                        @foreach($allAlbumData as $album)
                                                                            <option
                                                                                value="{{$album->id}}">{{$album->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <select class="form-control form-control-sm"
                                                                            id="gallery_date" name="gallery_date">
                                                                        <option value="">Select Date</option>
                                                                        @foreach($galleryDate as $key=>$date)
                                                                            <option
                                                                                value="{{$key}}">{{$date}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="search" name="search"
                                                                   id="search_media_file"
                                                                   class="form-control form-control-sm ">
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <form action="{{route('manage-media.index')}}">
                                                                <input type="hidden" name="mode" value="list">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <input type="hidden" name="mode" value="list">

                                                                        <select name="media_types"
                                                                                id="media-attachment-filters"
                                                                                class="attachment-filters form-control form-control-sm">
                                                                            <option value="">All media items</option>
                                                                            <option value="image">Images</option>
                                                                            <option value="audio">Audio</option>
                                                                            <option value="video">Video</option>
                                                                            <option value="document">Documents</option>
                                                                            <option value="other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control form-control-sm"
                                                                                id="album_id" name="album_id">
                                                                            <option value="">Select Album</option>
                                                                            @foreach($allAlbumData as $album)
                                                                                <option
                                                                                    value="{{$album->id}}">{{$album->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <select class="form-control form-control-sm"
                                                                                id="gallery_date" name="gallery_date">
                                                                            <option value="">Select Date</option>
                                                                            @foreach($galleryDate as $key=>$date)
                                                                                <option
                                                                                    value="{{$key}}">{{$date}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button class="btn btn-success btn-sm">Filter
                                                                        </button>
                                                                    </div>

                                                                </div>

                                                            </form>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <form action="{{route('manage-media.index')}}">
                                                                <div class="row">
                                                                    <div class="col-md-7" style="padding-right: 0;">
                                                                        <input type="hidden" name="mode" value="list">
                                                                        <input type="search" name="search"
                                                                               id="search_media_file"
                                                                               class="form-control form-control-sm ">
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <button class="btn btn-success btn-sm">Search
                                                                            Media
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                @include('backend.layouts.message')
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @yield('media-content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('javascript-section')


@endsection

