@extends('layouts.frontend.app')

@section('title','Tag | '.$tag->name)

@push('styles')

    <link href="{{ asset('frontend/category/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/category/css/responsive.css') }}" rel="stylesheet">

    <style type="text/css">
        .slider { background: url({{ asset('frontend/images/slider-1.jpg')}}); }
    </style>
@endpush

@section('content')
<div class="slider display-table center-text">
    <h1 class="title display-table-cell">Tag : <b>{{ $tag->name }}</b></h1>
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

                            <h4 class="title"><a href="{{ route('posts.single',$data->slug) }}"><b>{{ $data->title }}</b></a></h4>

                            <ul class="post-footer">
                                <li>
                                    @guest
                                        <a href="javascript:void(0)" onclick="toastr.info('To add you need to login.','Info',{
                                            closeButton:true,
                                            progressBar:true,
                                        });"><i class="ion-heart"></i>{{ $data->favorite_to_users->count() }}</a>
                                    @else
                                        <a href="javascript:void(0)" onclick="getElementById('favorite-form-{{ $data->id }}').submit();" ><i class="ion-heart 
                                            {{ !Auth::user()->favorite_posts->where('pivot.post_id',$data->id)->count() == 0 ? 'favorite-post' : '' }}
                                            "></i>{{ $data->favorite_to_users->count() }}</a>
                                        <form id="favorite-form-{{ $data->id }}" method="post" action="{{ route('favorite.post.add',$data->id) }}">
                                            @csrf
                                        </form>
                                    @endguest
                                    
                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>{{ $data->comments->count() }}</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $data->view_count }}</a></li>
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
