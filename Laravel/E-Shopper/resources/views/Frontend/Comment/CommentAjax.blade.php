
    {{-- < action="/blog/comment/ajax/{{$blogDetail->id}}" method="POST" id="commentForm"> --}}
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a replay</h2>

                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <textarea class="cmt" name="cmt" rows="11"></textarea>
                    {{-- <input type="hidden" name="parent_id" id="parentId" value="0"> --}}
                    <a class="btn btn-primary postComment" >Post comment</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.postComment').click(function () {
    var checkLogin = "{{ Auth::check() }}";

    if (checkLogin) {
        var idBlog = {{$blogDetail->id}};
        var idUser = {{$user}};
        var cmt = $('.cmt').val();

        if (cmt.trim() === "") {
            alert("Nội dung bình luận không được để trống!");
            return;
        }

        $.ajax({
            type: 'POST',
            url: '{{ url("/blog/comment/ajax/" . $blogDetail->id) }}',
            data: {
                cmt: cmt,
                idBlog: idBlog,
                idUser: idUser,
            },
            success: function (response) {
                if (response.success) {
                    const newComment = response.data;
                    console.log(newComment);

                    const commentHtml = `
                        <li class="media" id="${newComment.id}">
                            <a class="pull-left" href="#">
                                <img class="media-object"  style="width:121px; height:86px" src="/upload/user/avatar/${newComment.avatar_user}" alt="${newComment.name_user}">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>${newComment.name_user}</li>
                                    <li><i class="fa fa-clock-o"></i>1:33 pm</li>
                                    <li><i class="fa fa-calendar"></i>DEC 5, 2023</li>
                                </ul>
                                <p>${newComment.cmt}</p>
                                <a class="btn btn-primary"><i class="fa fa-reply"></i>Reply</a>
                            </div>
                        </li>
                    `;

                    $('#commentList').append(commentHtml);

                    $('.cmt').val('');
                }
            },
            error: function () {
                alert('Đã xảy ra lỗi khi gửi bình luận. Vui lòng thử lại.');
            }
        });
    } else {
        alert("Phải đăng nhập mới bình luận được");
    }
});

        });
    </script>



