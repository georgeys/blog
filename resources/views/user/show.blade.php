@extends('layouts.main')
@section('content')
        <div class="col-sm-8">
            <blockquote>
                <p><img src="{{$user1->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{Auth::user()->name}}
                </p>
                <footer>关注：{{$user1->stars_count}}｜粉丝：{{$user1->fans_count}}｜文章：{{$user1->posts_count}}</footer>
            </blockquote>
        </div>
        <div class="col-sm-8 blog-main">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                    <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        @foreach($posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/user/{{$user1->id}}">{{$user1->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                            <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a></p>
                            {!! str_limit($post->content,100,'...') !!}
                        </div>
                        @endforeach
                            {{$posts->links()}}
                    </div>

                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">

                        @foreach($susers as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$user->name}}</p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>
                            @include('user.like',['target_user' => $user])
                        </div>
                        @endforeach
                            {{$susers->links()}}
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">
                        @foreach($fusers as $user)
                            <div class="blog-post" style="margin-top: 30px">
                                <p class="">{{$user->name}}</p>
                                <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>
                                @include('user.like',['target_user' => $user])
                            </div>
                        @endforeach
                        {{$fusers->links()}}
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>


        </div><!-- /.blog-main -->

@endsection