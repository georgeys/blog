@extends("layout.main")

@section("content")
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
               <h2 class="blog-post-title">{{$post -> title}}</h2>
	            @can('update',$post)
               <a style="margin: auto"  href="/posts/{{$post -> id}}/edit">
                   <span class="glyphicon glyphicon-pencil" aria-hidden="true">编辑</span>
               </a>
	            @endcan
	            @can('delete',$post)
	            <span style="margin: auto">||</span>
                <a style="margin: auto"  href="/posts/{{$post -> id}}/delete">
                   <span class="glyphicon glyphicon-remove" aria-hidden="true">删除</span>
                </a>
	            @endcan
            </div>

            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}
	            <a href="#">{{$post->user->name}}</a>
            </p>
            <p>{!! $post->content !!}</p>
            <div>

             @if($post->zan(\Auth::id())->exists())
            <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-default  btn-lg">取消赞</a>
            @else
            <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary  btn-lg">赞</a>
            </div>
            @endif
            @if($post->zans)
            @foreach($post->zans as $zan)
               {{$zan->user->name.","}}
            @endforeach
                觉得很赞
            @endif
        </div>


        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">
	            @foreach($post->comments as $comm)
               <li class="list-group-item">
                    <h5>{{$comm -> created_at}} by{{$comm->user->name}} </h5>
                    <div>
                       {{$comm->content}}
                    </div>
                </li>
	            @endforeach
             </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->

            <ul class="list-group">
                <form action="/posts/{{$post->id}}/comment" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
	                <input type="hidden" name="post_id" value="{{$post->id}}"/>
	                <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        @include('layout.error')
	                    <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
@endsection


