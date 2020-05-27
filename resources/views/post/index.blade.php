@extends("layout.main")
@section("content")
        <div class="col-sm-8 blog-main">
		@include("layout.img")
        </div>
        <div>
	        @foreach($posts as $post)
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="/posts/{{$post -> id}}" >{{$post->title}}</a></h2>
                <p class="blog-post-meta">{{$post -> created_at}}<a href="/user/5">Kassandra Ankunding2</a></p>
                 {!! str_limit($post -> content,150,'...')!!}
                <p class="blog-post-meta">赞 0  | 评论 0</p>
            </div>
	        @endforeach


            <ul class="pagination">

                    <li class="disabled"><span>&laquo;</span></li>
	            <li class="active"><span>1</span></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=2">2</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=3">3</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=4">4</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=5">5</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=6">6</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=7">7</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=8">8</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=9">9</a></li>
	            <li><a href="http://127.0.0.1:8000/posts?page=10">10</a></li>
                <li><a href="http://127.0.0.1:8000/posts?page=2" rel="next">&raquo;</a></li>
            </ul>

        </div><!-- /.blog-main -->
    </div>
@endsection