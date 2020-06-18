@extends("admin.layout.main")
@section("content")
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="box">
                    <div class="blog-post">
                        <div style="display:inline-flex">
                            <h2 class="blog-post-title">{{$post -> title}}</h2>
                        </div>

                        <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}}
                            <a href="#">{{$post->user->name}}</a>
                        </p>
                        <p style="width: 100%">{!! $post->content !!}</p>
                        <a href="javascript:history.back(-1)" >
                            <span style="color: black;line-height: 50px">返回</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection