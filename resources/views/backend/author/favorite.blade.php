@extends('layouts.backend.app')

@section('title','Admin | Favorite Posts')

@push('css')
<!-- JQuery DataTable Css -->
<link href="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endpush
@section('content')
    <div class="container-fluid">
        <div class="block-header">

        </div>
        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Favorite Posts
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">comment</i></th>
                                    <th><i class="material-icons">remove_red_eye</i></th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th><i class="material-icons">favorite</i></th>
                                    <th><i class="material-icons">comment</i></th>
                                    <th><i class="material-icons">remove_red_eye</i></th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $posts as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->user->name }}</td>
                                        <td>{{ $data->favorite_to_users->count() }}</td>
                                        <td>{{ $data->view_count }}</td>
                                        <td>{{ $data->view_count }}</td>
                                        <td>
                                            <button type="button" class="btn btn-success waves-effect " data-toggle="modal" data-target="#">
                                                <i class="material-icons">visibility</i>
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect"
                                                    onclick="if(confirm('Are You sure want To Remove?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{ $data->id }}').submit();
                                                            } else {
                                                            event.preventDefault();
                                                            }" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $data->id }}" style="display: none;" action="{{  route('author.posts.favorite.delete',$data->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection

@push('js')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

<script src="{{ asset('backend/js/pages/tables/jquery-datatable.js') }}"></script>

@endpush