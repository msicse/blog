@extends('layouts.backend.app')

@section('title','Admin | Comments')

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
                            All Comments
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-center">Comment Info </th>
                                    <th class="text-center">Post Info</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th class="text-center">Comment Info </th>
                                    <th class="text-center">Post Info</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach( $comments as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                  <img src="{{ asset('storage/user/'.$data->user->image) }}" class="media-object" style="width:125px">
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading">{{ $data->user->name }} </h4>
                                                  <small><i>Commented on {{ date('F d, Y', strtotime($data->created_at)) }} at {{ date('g:i a', strtotime($data->created_at)) }}</i></small>
                                                  <p>{{ $data->comment }}</p>

                                                  <a href="{{ route('posts.single',$data->post->slug . '#reply-'.$data->id) }}" target="_blank" class="btn btn-primary">Reply</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-left">
                                                  <img src="{{ asset('storage/post/'.$data->post->image) }}" class="media-object" style="width:125px">
                                                </div>
                                                <div class="media-body">
                                                  <h4 class="media-heading"><a href="{{ route('posts.single',$data->post->slug) }}" target="_blank">{{ $data->post->title }}</a></h4>
                                                  <p>By {{ $data->post->user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success waves-effect " data-toggle="modal" data-target="#">
                                                <i class="material-icons">visibility</i>
                                            </button>

                                            <button type="button" class="btn btn-primary waves-effect  tag_edit" data-toggle="modal" data-target="#EditTag" data-id="{{ $data->id }}">
                                                <i class="material-icons">edit</i>
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect"
                                                    onclick="if(confirm('Are You sure want To Delete?')){
                                                            event.preventDefault();
                                                            document.getElementById('delete-form-{{ $data->id }}').submit();
                                                            } else {
                                                            event.preventDefault();
                                                            }" >
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <form id="delete-form-{{ $data->id }}" style="display: none;" action="{{  route('admin.comments.destroy',$data->id) }}" method="post">
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