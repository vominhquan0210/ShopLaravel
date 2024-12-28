@extends('Frontend.master');
@section('noi_dung')
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-9">
                    <div class="blog-post-area">
                        <h2 class="title text-center">Latest From our Blog</h2>
                        <div class="single-blog-post">
                            <h3>{{ $blogDetail->tittle }}</h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> Mac Doe</li>
                                    <li><i class="fa fa-clock-o"></i> {{ $blogDetail->created_at }}</li>
                                    <li><i class="fa fa-calendar"></i>{{ $blogDetail->updated_at }}</li>
                                </ul>

                            </div>
                            <a href="">
                                <img style="height:392.38px" src="{{ asset('upload/user/avatar/' . $blogDetail->avatar) }}"
                                    alt="">
                            </a>
                            <p>
                                {!! $blogDetail->content !!}
                            <p>

                            <div class="pager-area">
                                <ul class="pager pull-right">
                                    @if ($preButton)
                                        <li><a href="/blog/{{ $preButton->id }}">Pre</a></li>
                                    @endif
                                    @if ($nextButton)
                                        <li><a href="/blog/{{ $nextButton->id }}">Next</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div><!--/blog-post-area-->

                    <div class="rating-area">
                        <ul class="ratings">
                            <li class="rate-this">Rate this item:</li>
                            <li>
                                <div class="rate">
                                    <div class="vote">
                                        <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                        <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                        <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                        <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                        <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                        <span class="rate-np">4.5</span>
                                    </div>
                                </div>
                            </li>
                            <li class="color">(6 votes)</li>
                        </ul>
                        <ul class="tag">
                            <li>TAG:</li>
                            <li><a class="color" href="">Pink <span>/</span></a></li>
                            <li><a class="color" href="">T-Shirt <span>/</span></a></li>
                            <li><a class="color" href="">Girls</a></li>
                        </ul>
                    </div><!--/rating-area-->

                    <div class="socials-share">
                        <a href=""><img src="images/blog/socials.png" alt=""></a>
                    </div><!--/socials-share-->

                    {{-- @include('Frontend.Comment.ListComment'); --}}

                   {{-- @include('Frontend.Comment.Comment') --}}

                   @include('Frontend.Comment.ListCommentAjax')

                   @include('Frontend.Comment.CommentAjax')
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        var averageRate = {{ $average ?? 0 }};
        for (var i = 0; i < averageRate; i++) {
            $('.ratings_stars').eq(i).addClass('ratings_over');
        }

            $('.ratings_stars').hover(
                function() {
                    $(this).prevAll().andSelf().addClass('ratings_hover');
                },
                function() {
                    $(this).prevAll().andSelf().removeClass('ratings_hover');
                }
            );

            $('.ratings_stars').click(function() {
                var checkLogin = "{{ Auth::check() }}";
                if (checkLogin) {
                    var Value = $(this).find("input").val();
                    var id_blog = {{$blogDetail->id}};
                    var id_user = {{$user}};

                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }

                    $.ajax({
            type: "POST",
            url: '{{url("/blog/rate/ajax")}}',
            data: {
                rate: Value,
                id_blog: id_blog,
                id_user: id_user,
            },
            success: function(data) {
              console.log(data);

            },
            error: function() {
                alert("Đã xảy ra lỗi khi gửi đánh giá.");
            }
        });
                } else {
                    alert('Phải đăng nhập mới đánh giá được');
                }

            });
        });
    </script>
@endsection
