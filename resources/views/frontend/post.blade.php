@extends('layouts.frontend.app')

@section('title','Posts | '.$post->title)

@push('styles')

    <link href="{{ asset('frontend/post/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('frontend/post/css/responsive.css') }}" rel="stylesheet">

    <style type="text/css">
        .slider {
            background-image: url({{ asset('storage/post/'.$post->image) }});
        }
        .element li {
            margin: 0 5px;
        }
        .reply-btn { cursor: pointer; }
        .reply { display: none; }
    </style>
@endpush

@section('content')

<div class="slider">
    <div class="display-table  center-text">
        <h1 class="title display-table-cell"><b></b></h1>
    </div>
</div><!-- slider -->

<section class="post-area section">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 col-md-12 no-right-padding">

                <div class="main-post">

                    <div class="blog-post-inner">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="{{ route('author',$post->user->username) }}"><img src="{{ asset('storage/user/'.$post->user->image) }}" alt="{{$post->image}}"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="{{ route('author',$post->user->username) }}"><b>{{ $post->user->name }}</b></a>
                                <h6 class="date">on {{ date('F d, Y', strtotime($post->created_at)) }} at {{ date('g:i a', strtotime($post->created_at)) }} (
                                    {{ $post->created_at->diffForHumans() }} )</h6>
                            </div>

                        </div><!-- post-info -->

                        <h3 class="title"><a href="#"><b>{{ $post->title }}</b></a></h3>

                        <div class="para">
                            {!! html_entity_decode($post->body)  !!}
                        </div>

                        <ul class="tags">
                            @foreach($post->tags as $tag)
                                <li><a href="{{ route('tags',$tag->slug) }}">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- blog-post-inner -->

                    <div class="post-icons-area">
                        <ul class="post-icons">
                            <li>
                            @guest
                                <a href="javascript:void(0)" onclick="toastr.info('To add you need to login.','Info',{
                                    closeButton:true,
                                    progressBar:true,
                                });"><i class="ion-heart"></i>{{ $post->favorite_to_users->count() }}</a>
                            @else
                                <a href="javascript:void(0)" onclick="getElementById('favorite-form-{{ $post->id }}').submit();" ><i class="ion-heart 
                                    {{ !Auth::user()->favorite_posts->where('pivot.post_id',$post->id)->count() == 0 ? 'favorite-post' : '' }}
                                    "></i>{{ $post->favorite_to_users->count() }}</a>
                                <form id="favorite-form-{{ $post->id }}" method="post" action="{{ route('favorite.post.add',$post->id) }}">
                                    @csrf
                                </form>
                            @endguest
                        </li>
                            <li><a href="#"><i class="ion-chatbubble"></i>{{ $post->comments->count() }}</a></li>
                            <li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>

                        </ul>

                        <ul class="icons">
                            <li>SHARE : </li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                        </ul>
                    </div>


                </div><!-- main-post -->
            </div><!-- col-lg-8 col-md-12 -->

            <div class="col-lg-4 col-md-12 no-left-padding">

                <div class="single-post info-area">

                    <div class="sidebar-area about-area">
                        <h4 class="title"><b>ABOUT AUTHOR</b></h4>
                        <p>{{ $post->user->about }}</p>
                    </div>

                    <div class="tag-area">

                        <h4 class="title"><b>CATEGORIES</b></h4>
                        <ul>
                            @foreach($post->categories as $category)
                                <li><a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a></li>
                            @endforeach
                            
                        </ul>

                    </div><!-- subscribe-area -->

                </div><!-- info-area -->

            </div><!-- col-lg-4 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section><!-- post-area -->

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
            </div><!-- col-md-6 col-sm-12 -->
            @endforeach
        </div><!-- row -->

    </div><!-- container -->
</section>

<!-- Comments Area -->
<section class="comment-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
            @guest
            
                
            @else
        
            <h4><b>POST COMMENT</b></h4>
            <div class="comment-form" id="comments">
                    <form method="post" action="{{ route('comments.store',$post->id) }}">
                        @csrf
                        <div class="col-sm-12">
                            <textarea name="comment" rows="2" class="text-area-messge form-control"
                                placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
                        </div><!-- col-sm-12 -->
                        
                        <div class="col-sm-12">
                            <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b></button>
                        </div><!-- col-sm-12 -->
                    </form>  
            </div><!-- comment-form -->
         @endguest

                <h4><b>COMMENTS({{ $post->comments->count() }})</b></h4>

                <div class="commnets-area">
                    @if( $post->comments->count() == 0)
                        <div class="text-center"> <b>no comments</b></div>
                    @endif
                    @foreach( $post->comments as $comment )
                    <div class="comment">

                        <div class="post-info">

                            <div class="left-area">
                                <a class="avatar" href="{{ route('author',$comment->user->username) }}"><img src="{{ Storage::disk('public')->url('user/'.$comment->user->image) }}" alt="Profile Image"></a>
                            </div>

                            <div class="middle-area">
                                <a class="name" href="{{ route('author',$comment->user->username) }}"><b>{{ $comment->user->name }}</b></a>
                                <h6 class="date">on {{ date('F d, Y', strtotime($comment->created_at)) }} at {{ date('g:i a', strtotime($comment->created_at)) }}</h6>
                            </div>
                            @guest
                            @else
                            <div class="right-area">
                                <h5 class="reply-btn" onclick="addReply({{ $comment->id }})" ><b>REPLY</b></h5>
                            </div>
                            @endguest

                        </div><!-- post-info -->

                        <p>{{ $comment->comment }}</p>
                    </div>
                    <div class="col-md-11 offset-md-1">
                        <div id="reply-{{ $comment->id }}" class="comment-form reply">
                            <form method="post" action="{{ route('reply.store',$comment->id) }}">
                                @csrf
                                <div class="col-sm-12">
                                    <textarea name="reply" rows="2" class="text-area-messge form-control"
                                        placeholder="Enter your reply" aria-required="true" aria-invalid="false"></textarea >
                                </div><!-- col-sm-12 -->
                                
                                <div class="col-sm-12">
                                    <button class="submit-btn" type="submit" id="form-submit"><b>REPLY</b></button>
                                </div><!-- col-sm-12 -->
                            </form>  
                        </div><!-- comment-form -->
                        @if( $comment->replies->count() > 0)
                        <h5 class="reply-for">Reply for <a href="{{ route('author',$comment->user->username) }}"><b>{{ $comment->user->name }}</b></a></h5>

                        @foreach( $comment->replies as $reply )
                        <div class="comment">
                        
                            <div class="post-info">

                                <div class="left-area">
                                <a class="avatar" href="{{ route('author',$reply->user->username) }}"><img src="{{ Storage::disk('public')->url('user/'.$reply->user->image) }}" alt="Profile Image"></a>
                            </div>

                                <div class="middle-area">
                                    <a class="name" href="{{ route('author',$reply->user->username) }}"><b>{{ $reply->user->name }}</b></a>
                                    <h6 class="date">on {{ date('F d, Y', strtotime($reply->created_at)) }} at {{ date('g:i a', strtotime($reply->created_at)) }}</h6>
                                </div>

                            </div><!-- post-info -->

                            <p>{{ $reply->reply }}</p>

                        </div>
                        @endforeach
                        @endif
                    </div>
                    
                    @endforeach
                </div><!-- commnets-area -->

                <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

            </div><!-- col-lg-8 col-md-12 -->

        </div><!-- row -->

    </div><!-- container -->
</section>
@endsection


@push('js')
    <script type="text/javascript">

        $( document ).ready(function() {
            
           //url = document.getElementById("url").innerText;
            url = document.URL;
            if(url) {
                str = url.substring(url.indexOf("#") + 1);

                //alert(str)
                
                var replyId = document.getElementById(str);

                replyId.classList.remove("reply");
                
            }
            
        });
        function addReply(id) {
            var element = document.getElementById("reply-"+id);
            element.classList.toggle("reply")
        }

    </script>
@endpush
