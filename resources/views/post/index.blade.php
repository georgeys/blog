@extends("layouts.main")
@section("content")
        <div class="col-sm-8 blog-main">
		@include("layouts.img")
        </div>
        <div>
	        @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/posts/{{$post -> id}}" >{{$post->title}}</a></h2>
                <p class="blog-post-meta">{{$post -> created_at}}<a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></p>
                 {!! str_limit($post -> content,150,'...')!!}
                <p class="blog-post-meta">赞 {{$post->zans_count}}  | 评论 {{$post->comments_count}}</p>
            </div>
	        @endforeach
            <ul class="pagination">
                <li>{{$posts->links()}}</li>
            </ul>

        </div><!-- /.blog-main -->
    </div>
@endsection