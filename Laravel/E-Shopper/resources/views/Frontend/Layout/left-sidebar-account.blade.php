<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Account</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->


            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="/user/profile/{{Auth::id()}}">Account</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="/user/product/{{Auth::id()}}">My product</a></h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="/create/product">Create product</a></h4>
                </div>
            </div>

        </div><!--/category-products-->


    </div>
</div>
