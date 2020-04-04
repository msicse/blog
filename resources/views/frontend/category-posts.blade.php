@extends('layouts.frontend.app')

@section('title','Category')

@push('styles')

    <link href="{{ asset('frontend/all-post/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/all-post/css/responsive.css') }}" rel="stylesheet">

    <style type="text/css">
        .title { color: #fff; }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell"><b>{{ $category->name }}</b></h1>
</div><!-- slider -->

<section class="blog-area section">
    <div class="container">

        <div class="row">

            @foreach($posts as $data)

            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/post/'.$data->image) }}" alt="{{ $data->image }}}"></div>

                        <a class="avatar" href="{{ route('author',$data->user->username) }}"><img src="{{ asset('storage/user/'.$data->user->image) }}" alt="{{ $data->user->image }}"></a>

                        <div class="blog-info">

                            <h4 class="title"><a href="#"><b>{{ $data->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li><a href="#"><i class="ion-heart"></i>57</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>138</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->

            @endforeach
        </div><!-- row -->
        {{ $posts->links() }}
    </div><!-- container -->
</section><!-- section -->

@endsection
