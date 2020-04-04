@extends('layouts.backend.app')

@section('title','Admin | ')

@push('css')

@endpush

@section('content')
    <!-- TinyMCE -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        TINYMCE
                        <small>Taken from <a href="https://www.tinymce.com" target="_blank">www.tinymce.com</a></small>
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <textarea id="mytextarea"></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# TinyMCE -->
@endsection

@push('js')
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