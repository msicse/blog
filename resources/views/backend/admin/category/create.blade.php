@extends('layouts.backend.app')

@section('title','Admin | Tags | Create')

@push('css')

@endpush

@section('content')
<!-- Vertical Layout | With Floating Label -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    ADD NEW TAG
                </h2>

            </div>
            <div class="body">
                <form action="{{ route('admin.tags.store')}}" method="post">
                	@csrf
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" id="name" name="name" class="form-control">
                            <label class="form-label">Tag Name</label>
                        </div>
                    </div>
                    <a href="{{ route('admin.tags.index') }}" class="btn btn-danger m-t-15 waves-effect">Back</a>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Vertical Layout | With Floating Label -->
@endsection

@push('js')

@endpush