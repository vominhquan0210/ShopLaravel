<form action="/blog/comment/{{$blogDetail->id}}" method="POST" id="commentForm">
    @csrf
    <div class="replay-box">
        <div class="row">
            <div class="col-sm-12">
                <h2>Leave a replay</h2>

                <div class="text-area">
                    <div class="blank-arrow">
                        <label>Your Name</label>
                    </div>
                    <span>*</span>
                    <textarea name="cmt" rows="11"></textarea>
                    <input type="hidden" name="parent_id" id="parentId" value="0">
                    <a class="btn btn-primary postComment" >Post comment</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(){

       $('.postComment').click(function(){

        var checkLogin = "{{ Auth::check() }}";

        if(checkLogin){
            $('#commentForm').submit();
        } else {
            alert("Phải đăng nhập mới bình luận được");
        }

       })
    })
</script>

