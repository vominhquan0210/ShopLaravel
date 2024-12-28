<<div class="response-area">
    <h2>{{ $listComment->count() }} RESPONSES</h2>
    <ul class="media-list">
        @foreach ($listComment as $comment)
            @if ($comment->level == 0)
                <li class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" style="width:121px; height:86px"
                            src="{{ asset('upload/user/avatar/' . $comment->avatar_user) }}"
                            alt="{{ $comment->avatar_user }}">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{ $comment->name_user }}</li>
                            <li><i class="fa fa-clock-o"></i>{{ date($comment->updated_at) }}</li>
                            <li><i class="fa fa-calendar"></i>{{ date($comment->created_at) }}</li>
                        </ul>
                        <p>{{ $comment->cmt }}</p>
                        <a class="btn btn-primary replay-btn" id="{{ $comment->id }}">
                            <i class="fa fa-reply"></i>Replay
                        </a>
                    </div>

                    @foreach ($listComment as $childComment)
                        @if ($childComment->level == $comment->id)
                <li class="media second-media" style="margin-left: 50px;">
                    <a class="pull-left" href="#">
                        <img class="media-object" style="width:121px; height:86px"
                            src="{{ asset('upload/user/avatar/' . $childComment->avatar_user) }}"
                            alt="{{ $childComment->avatar_user }}">
                    </a>
                    <div class="media-body">
                        <ul class="sinlge-post-meta">
                            <li><i class="fa fa-user"></i>{{ $childComment->name_user }}</li>
                            <li><i class="fa fa-clock-o"></i>{{ date($childComment->updated_at) }}</li>
                            <li><i class="fa fa-calendar"></i>{{ date($childComment->created_at) }}</li>
                        </ul>
                        <p>{{ $childComment->cmt }}</p>
                        <a class="btn btn-primary replay-btn" id="{{ $childComment->id }}">
                            <i class="fa fa-reply"></i>Replay
                        </a>
                    </div>
                </li>
            @endif
        @endforeach
        </li>
        @endif
        @endforeach
    </ul>
    </div>


    <script>
        $(document).ready(function() {
            $('.replay-btn').click(function() {
                var parentCommentId = $(this).attr('id');

                $('#parentId').val(parentCommentId);
                console.log(parentCommentId);
            });
        });
    </script>
