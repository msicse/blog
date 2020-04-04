@extends('layouts.frontend.app')

@section('title','Posts | '.$post->title)

@push('styles')

    <link href="{{ asset('frontend/single-post/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/single-post/css/responsive.css') }}" rel="stylesheet">

    <style type="text/css">
        .slider {
            background-image: url({{ asset('storage/post/'.$post->image) }});
        }
        .element li {
            margin: 0 5px;
        }
    </style>
@endpush

@section('content')
<div class="slider">
    
</div><!-- slider -->

<section class="post-area">
    <div class="container">

        <div class="row">

            <div class="col-lg-1 col-md-0"></div>
            <div class="col-lg-10 col-md-12">

                <div class="main-post">

                    <div class="post-top-area footer-section">

                        <div class="element">
                            <ul>
                                @foreach( $post->categories as $category )
                           
                                <li><a href="{{ route('category',$category->slug) }}">{{ $category->name }} </a></li>

                                @endforeach

                            </ul>

                            
                        </div>

                        <h3 class="title"><a href="{{ route('posts.single',$post->slug) }}"><b>{{ $post->title }}</b></a></h3>

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="{{ route('author',$post->user->username) }}"><img src="{{ asset('storage/user/'.$post->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="{{ route('author',$post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date"> on {{ date('F d, Y', strtotime($post->created_at)) }} at {{ date('g:i a', strtotime($post->created_at)) }} </h6>
                            </div>

                        </div><!-- post-info -->

                        <p class="para">{!! $post->body !!}</p>

                    </div><!-- post-top-area -->

                    <div class="post-bottom-area">

                        <ul class="tags">
                            @foreach($post->tags as $tag)
                            <li><a href="{{ route('tags',$tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>

                        <div class="post-icons-area">
                            <ul class="post-icons">
                                <li><a href="#"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a></li>
                                <li><a href="#"><i class="ion-chatbubble"></i>cmt</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>
                            </ul>

                            <ul class="icons">
                                <li>SHARE : </li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>

                        <div class="post-footer post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="{{ asset('storage/user/'.$post->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date"> on {{ date('F d, Y', strtotime($post->created_at)) }} at {{ date('g:i a', strtotime($post->created_at)) }} </h6>
                            </div>

                        </div><!-- post-info -->

                    </div><!-- post-bottom-area -->

                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->
        </div><!-- row -->
    </div><!-- container -->
</section><!-- post-area -->

<!-- Related Post Area -->

<section class="recomended-area section">
    <div class="container">
        <div class="row">
            @foreach( $randoms as $data)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="single-post post-style-1">

                        <div class="blog-image"><img src="{{ asset('storage/post/'.$data->image) }}" alt="{{ $data->image }}}"></div>

                        <a class="avatar" href="#"><img src="{{ asset('storage/user/'.$data->user->image) }}" alt="{{ $data->user->image }}"></a>

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
            </div><!-- col-md-6 col-sm-12 -->
            @endforeach
            
        </div><!-- row -->

    </div><!-- container -->
</section>

<!-- Comment Post Area -->
<section class="comment-section center-text">
    <div class="container">
        <h4><b>POST COMMENT</b></h4>
        <div class="row">

            <div class="col-lg-2 col-md-0"></div>

            <div class="col-lg-8 col-md-12">
                <div class="comment-form">
                    @guest
                    <p>Post a new comment, you need to login first. <a href="{{ route('login') }}"><b>login</b></a>  </p>

                    @else
                      <form method="post">
                        <div class="row">

                            <div class="col-sm-6">
                                <input type="text" aria-required="true" name="contact-form-name" class="form-control"
                                    placeholder="Enter your name" aria-invalid="true" required >
                            </div><!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <input type="email" aria-required="true" name="contact-form-email" class="form-control"
                                    placeholder="Enter your email" aria-invalid="true" required>
                            </div><!-- col-sm-6 -->

                            <div class="col-sm-12">
                                <textarea name="contact-form-message" rows="2" class="text-area-messge form-control"
                                    placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                            </div><!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                            </div><!-- col-sm-12 -->

                        </div><!-- row -->
                    </form>
                    @endguest
                </div><!-- comment-form -->

                <h4><b>COMMENTS(12)</b></h4>

                <div class="commnets-area text-left">

                    <div class="comment">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>Katy Liu</b></a>
                                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                            </div>

                            <div class="right-area">
                                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                            </div>

                        </div><!-- post-info -->

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                            Ut enim ad minim veniam</p>

                    </div>

                    <div class="comment">
                        <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>Katy Liu</b></a>
                                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                            </div>

                            <div class="right-area">
                                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                            </div>

                        </div><!-- post-info -->

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                            Ut enim ad minim veniam</p>

                    </div>

                </div><!-- commnets-area -->

                <div class="commnets-area text-left">

                    <div class="comment">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="#"><b>Katy Liu</b></a>
                                <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                            </div>

                            <div class="right-area">
                                <h5 class="reply-btn" ><a href="#"><b>REPLY</b></a></h5>
                            </div>

                        </div><!-- post-info -->

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                            Ut enim ad minim veniam</p>

                    </div>

                </div><!-- commnets-area -->

                <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection
