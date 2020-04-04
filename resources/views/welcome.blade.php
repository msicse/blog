@extends('layouts.frontend.app')

@section('title','Home')

@push('styles')
    <link href="{{ asset('frontend/home/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/home/css/responsive.css') }}" rel="stylesheet">

@endpush
@section('content')

<div class="main-slider">
    <div class="swiper-container position-static" data-slide-effect="slide" data-autoheight="false"
        data-swiper-speed="500" data-swiper-autoplay="10000" data-swiper-margin="0" data-swiper-slides-per-view="4"
        data-swiper-breakpoints="true" data-swiper-loop="true" >
        <div class="swiper-wrapper">
            @foreach($categories as $data)
            <div class="swiper-slide">
                <a class="slider-category" href="{{ route('category',$data->slug) }}">
                    <div class="blog-image"><img src="{{ asset('storage/category/'.$data->image)}}" alt="{{ $data->name }}"></div>

                    <div class="category">
                        <div class="display-table center-text">
                            <div class="display-table-cell">
                                <h3><b>{{ $data->name }}</b></h3>
                            </div>
                        </div>
                    </div>

                </a>
            </div><!-- swiper-slide -->
            @endforeach

        </div><!-- swiper-wrapper -->
    </div><!-- swiper-container -->
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
                                <li><a href="javascript:void(0)"><i class="ion-eye"></i>{{ $data->view_count }}</a></li>
                            </ul>

                        </div><!-- blog-info -->
                    </div><!-- single-post -->
                </div><!-- card -->
            </div><!-- col-lg-4 col-md-6 -->

            @endforeach
        </div><!-- row -->
        @if( $posts->count() == 9)
            <a class="load-more-btn" href="{{ route('posts') }}"><b>VIEW ALL</b></a>
        @endif
    </div><!-- container -->
</section><!-- section -->

@endsection
