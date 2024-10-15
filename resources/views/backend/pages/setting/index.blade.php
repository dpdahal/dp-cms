<?php
$columnName = "logo";
?>
@extends('backend.master.main')
@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2 mt-3">
                                    <h2><i class="bi bi-gear"></i> Setting</h2>
                                    <hr>
                                    @include('lib.message')
                                </div>
                            </div>
                            <div class="row">
                                <form action="{{route('setting')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <!-- Default Tabs -->
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="general-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#general"
                                                                    type="button" role="tab" aria-controls="general"
                                                                    aria-selected="true">General
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="contact-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#contact"
                                                                    type="button" role="tab" aria-controls="contact"
                                                                    aria-selected="true">Contact
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="logo-icons-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#logo"
                                                                    type="button" role="tab" aria-controls="log"
                                                                    aria-selected="false" tabindex="-1">Logo & Icons
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="social-media-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#social-media"
                                                                    type="button" role="tab"
                                                                    aria-controls="social-media"
                                                                    aria-selected="false" tabindex="-1">Social Media
                                                            </button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="seo-tab"
                                                                    data-bs-toggle="tab" data-bs-target="#seo"
                                                                    type="button" role="tab" aria-controls="seo"
                                                                    aria-selected="false" tabindex="-1">SEO
                                                            </button>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content pt-2 mt-3" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="general"
                                                             role="tabpanel"
                                                             aria-labelledby="general-tab">
                                                            <div class="form-group mb-3">
                                                                <label for="name">Name:
                                                                    <a style="color: red;">{{$errors->first('name')}}</a>
                                                                </label>
                                                                <input type="text" id="name" name="name"
                                                                       class="form-control"
                                                                       value="{{$settingData->name}}">
                                                            </div>


                                                            <div class="form-group mb-2">
                                                                <label for="description">Description:
                                                                    <a style="color: red;">{{$errors->first('description')}}</a>
                                                                </label>
                                                                <textarea name="description"
                                                                          id="description"
                                                                          class="form-control">{{$settingData->description}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="contact"
                                                             role="tabpanel"
                                                             aria-labelledby="contact-tab">

                                                            <div class="form-group mb-2">
                                                                <label for="email">Email</label>
                                                                <input type="text" id="email" name="email"
                                                                       value="{{$settingData->email}}"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="phone">Phone</label>
                                                                <input type="text" id="phone" name="phone"
                                                                       value="{{$settingData->phone}}"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="mobile">Mobile</label>
                                                                <input type="text" id="mobile" name="mobile"
                                                                       value="{{$settingData->mobile}}"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group mb-2">
                                                                <label for="address">Address</label>
                                                                <input type="text" id="address"
                                                                       value="{{$settingData->address}}"
                                                                       class="form-control">
                                                            </div>


                                                        </div>
                                                        <div class="tab-pane fade" id="logo" role="tabpanel"
                                                             aria-labelledby="logo-icons-tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    @include('backend.layouts.update-image',['tableName'=>$settingData->getTable(),'id'=>$settingData->id])
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="social-media" role="tabpanel"
                                                             aria-labelledby="social-media-tab">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group mb-2">
                                                                        <label for="facebook">Facebook</label>
                                                                        <input type="text" id="facebook" name="facebook"
                                                                               value="{{$settingData->facebook}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="twitter">Twitter</label>
                                                                        <input type="text" id="twitter" name="twitter"
                                                                               value="{{$settingData->twitter}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="linkedin">Linkedin</label>
                                                                        <input type="text" id="linkedin" name="linkedin"
                                                                               value="{{$settingData->linkedin}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="instagram">Instagram</label>
                                                                        <input type="text" id="instagram"
                                                                               name="instagram"
                                                                               value="{{$settingData->instagram}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="youtube">Youtube</label>
                                                                        <input type="text" id="youtube" name="youtube"
                                                                               value="{{$settingData->youtube}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="pinterest">pinterest</label>
                                                                        <input type="text" id="pinterest" name="pinterest"
                                                                               value="{{$settingData->pinterest}}"
                                                                               class="form-control">
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        <label for="whatsapp">whatsapp</label>
                                                                        <input type="text" id="whatsapp"
                                                                               name="whatsapp"
                                                                               value="{{$settingData->whatsapp}}"
                                                                               class="form-control">
                                                                    </div>


                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="seo" role="tabpanel"
                                                             aria-labelledby="seo-tab">
                                                            <div class="form-group mb-3">
                                                                <label for="meta_title">Meta Title:</label>
                                                                <input type="text" id="meta_title" name="meta_title"
                                                                       class="form-control"
                                                                       value="{{$settingData->meta_title}}">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="meta_description">Meta Description:</label>
                                                                <textarea name="meta_description" id="meta_description"
                                                                          class="form-control">{{$settingData->meta_description}}</textarea>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label for="meta_keywords">Meta Keywords:</label>
                                                                <textarea name="meta_keywords" id="meta_keywords"
                                                                          class="form-control">{{$settingData->meta_keywords}}</textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <button class="btn btn-primary">Save</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('description', {
                filebrowserUploadUrl: ckeditorUploadUrl,
                filebrowserUploadMethod: 'form'
            });

        });
    </script>
@endsection

