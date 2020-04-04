@extends('layouts.backend.app')

@section('title','Admin | Post | Create')

@push('css')

@endpush

@section('content')
<div class="container-fluid">

    <a href="{{ route('admin.posts.index') }}" class="btn btn-danger waves-effect">
        <i class="material-icons">keyboard_backspace</i>
        <span>Back</span>
    </a>

    @if($post->is_approved == true)
    <button type="button" class="btn btn-success waves-effect pull-right " disabled>
        <i class="material-icons">done</i>
        <span>Apporved</span>
    </button>
    @else
    <button type="button" class="btn btn-success waves-effect pull-right">
        <i class="material-icons">done</i>
        <span>Apporved</span>
    </button>
    @endif
    <br>
    <br>

    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        @csrf
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        {{ $post->title }}
                        <small> Posted By <strong> {{ $post->user->name }}</strong> on {{ $post->created_at->toFormattedDateString() }}</small>
                    </h2>

                </div>
                <div class="body">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-light-green">
                    <h2>
                        Categories
                    </h2>

                </div>
                <div class="body">
                    @foreach($post->categories as $category)
                        <span class="label bg-light-green">{{ $category->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-green">
                    <h2>
                        Tags
                    </h2>

                </div>
                <div class="body">
                    @foreach($post->tags as $tag)
                        <span class="label bg-green">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="header bg-blue-grey">
                    <h2>
                        Featured Image
                    </h2>

                </div>
                <div class="body">
                    <img class="img-responsive img-thumbnail" src="{{ Storage::disk('public')->url('post/'.$post->image) }}">
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->
</div>
@endsection

@push('js')


<script>
    
</script>


@endpush