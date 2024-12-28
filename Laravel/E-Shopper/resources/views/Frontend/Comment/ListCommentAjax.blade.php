<div class="response-area">
    <h2>RESPONSES</h2>
    <ul class="media-list" id="commentList">

    </ul>
</div>

<script>
 $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    function loadComments() {
    $.ajax({
        method: 'GET',
        url: '{{ url('/blog/comment/ajax/' . $blogDetail->id) }}',
        success: function (response) {
            const comments = response.data;



            comments.forEach(comment => {
                let childHtml = '';

                if (comment.level === 0) {

                    comments.forEach(childComment => {
                        if (childComment.level === comment.id) {
                            childHtml += `
                                <li class="media second-media" id="${childComment.id}">
                                    <a class="pull-left" href="#">
                                        <img class="media-object" style="width:121px; height:86px" src="/upload/user/avatar/${childComment.avatar_user}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <ul class="sinlge-post-meta">
                                            <li><i class="fa fa-user"></i>${childComment.name_user}</li>
                                            <li><i class="fa fa-clock-o"></i>${childComment.created_at}</li>
                                            <li><i class="fa fa-calendar"></i>${childComment.updated_at}</li>
                                        </ul>
                                        <p>${childComment.cmt}</p>
                                        <a class="btn btn-primary" href="#"><i class="fa fa-reply"></i>Reply</a>
                                    </div>
                                </li>`;
                        }
                    });

                    const commentHtml = `
                        <li class="media" id="${comment.id}">
                            <a class="pull-left" href="#">
                                <img class="media-object" style="width:121px; height:86px" src="/upload/user/avatar/${comment.avatar_user}" alt="${comment.name_user}">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>${comment.name_user}</li>
                                    <li><i class="fa fa-clock-o"></i>${comment.created_at}</li>
                                    <li><i class="fa fa-calendar"></i>${comment.updated_at}</li>
                                </ul>
                                <p>${comment.cmt}</p>
                                <a class="btn btn-primary reply-btn" id="${comment.id}"><i class="fa fa-reply"></i>Reply</a>
                                <div class="reply-input hidden" style="margin-top:10px">
                                    <textarea class="form-control reply-text" rows="3" placeholder="Nhập bình luận của bạn"></textarea>
                                    <button class="btn btn-success submit-reply" id="${comment.id}" style="margin-top: 5px;">Gửi</button>
                                </div>
                            </div>
                            <ul class="media-list">
                                ${childHtml}
                            </ul>
                        </li>`;

                    $('#commentList').append(commentHtml);
                }
            });
        },
        error: function () {
            alert('Không thể tải danh sách bình luận.');
        },
    });
}


    loadComments();

    $(document).on('click', '.reply-btn', function (e) {
        e.preventDefault();
        const replyInput = $(this).closest('li').find('.reply-input');
        replyInput.toggleClass('hidden');
    });

    $(document).on('click', '.submit-reply', function (e) {
        e.preventDefault();

        var parentId = $(this).attr('id');
        var cmt = $(this).closest('.reply-input').find('.reply-text').val();
        var idBlog = {{ $blogDetail->id }};
        var idUser = {{ $user }};

        $.ajax({
            type: "POST",
            url: '{{ url('/blog/comment/ajax/' . $blogDetail->id) }}',
            data: {
                parentId: parentId,
                cmt: cmt,
                idBlog: idBlog,
                idUser: idUser,
            },
            success: function (response) {
                if (response.success) {
                    const newComment = response.data;
                    const commentHtml = `
                        <li class="media second-media" id="${newComment.id}">
                            <a class="pull-left" href="#">
                                <img class="media-object" style="width:121px; height:86px" src="/upload/user/avatar/${newComment.avatar_user}" alt="${newComment.name_user}">
                            </a>
                            <div class="media-body">
                                <ul class="sinlge-post-meta">
                                    <li><i class="fa fa-user"></i>${newComment.name_user}</li>
                                    <li><i class="fa fa-clock-o"></i>${newComment.created_at}</li>
                                    <li><i class="fa fa-calendar"></i>${newComment.updated_at}</li>
                                </ul>
                                <p>${newComment.cmt}</p>
                                <a class="btn btn-primary" href="#"><i class="fa fa-reply"></i>Reply</a>
                            </div>
                        </li>`;

                    $(`#${parentId}`).find('.media-list').append(commentHtml);
                }
            },
            error: function () {
                alert('Không thể gửi bình luận.');
            },
        });
    });
});


</script>
