@extends('Frontend.master')

@section('noi_dung')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Latest From our Blog</h2>
                    @foreach ($blogs as $value )
                    <div class="single-blog-post">
                        <h3>{{ $value->tittle }}</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i>{{ $value->created_at }}</li>
                                <li><i class="fa fa-calendar"></i>{{ $value->updated_at }}</li>
                            </ul>
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>
                        <a href="">
                            <img style="width:846px; height:390px" src="{{ asset('upload/user/avatar/' . $value->avatar) }}" alt="">
                        </a>
                        <p>{!! $value->content !!}</p>
                        <a class="btn btn-primary" href="/blog/{{$value->id}}">Read More</a>
                    </div>
                    @endforeach

                    <div class="pagination-area">
                        {!! $blogs->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
