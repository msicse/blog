@extends('layouts.backend.app')

@section('title','Admin | Post | Create')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/plugins/multi-select/css/multi-select.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}">

@endpush

@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
        <div class="row clearfix">
            @csrf
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            ADD NEW POST
                        </h2>

                    </div>
                    <div class="body">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" value="{{ old('title') }}" id="title" name="title" class="form-control">
                                <label class="form-label">Post Title</label>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="">Feature Image</label>
                                <input type="file"  name="image" class="form-control">
                            </div>
                        </div>
                        <input type="checkbox" class="filled-in" id="ig_checkbox" name="publish" value="1">
                        <label for="ig_checkbox">Publish</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories and Posts
                        </h2>

                    </div>
                    <div class="body">
                        <p>
                            <b>Select Tags</b>
                        </p>
                        <select name="tags[]" class="form-control show-tick" data-live-search="true" multiple>
                            @foreach( $tags as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>

                        <p>
                            <b>Select Categories</b>
                        </p>
                        <select name="categories[]" class="form-control show-tick" data-live-search="true" multiple>
                            @foreach( $categories as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach

                        </select>
                        <a src="{{ route('admin.posts.index') }}" class="btn btn-danger m-t-15 waves-effect">
                            <i class="material-icons">keyboard_backspace</i>
                            <span>Back</span>
                        </a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect pull-right">
                            <i class="material-icons">publish</i>
                            <span>Publish</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->

        <!-- TinyMCE -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            BODY

                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="mytextarea" name="body">{{ old('body') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# TinyMCE -->
    </form>
</div>
@endsection

@push('js')

<!-- Multi Select Plugin Js -->
<script src="{{ asset('backend/plugins/multi-select/js/jquery.multi-select.js') }}"></script>
<!-- TinyMCE -->
<script src='{{ asset('backend\plugins\tinymce\tinymce.jquery.min.js') }}'></script>

<script>
    tinymce.init({
        selector: '#mytextarea',
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });

    tinymce.suffix = ".min";
    tinyMCE.baseURL = location.origin + '/backend/plugins/tinymce';


</script>


@endpush