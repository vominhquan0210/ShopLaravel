@extends('Frontend.master')
@section('noi_dung')
@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section>
    <div class="container">
        <div class="row">
           @include('Frontend.Layout.left-sidebar-account')
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Update Product</h2>
                     <div class="signup-form"><!--sign up form-->
                    <h2>Update Product</h2>
                    <form action="/update/product/{{$item->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <?php
                           $image = json_decode($item->image, true);
                        ?>
                        <input type="text" placeholder="Name" name="name" value="{{$item->name}}"/>
                        <input type="text" placeholder="Price" name="price" value="{{$item->price}}"/>
                        <select name="id_category">
                           @foreach ($category as $category)
                               <option value="{{$category->id}}" @selected($item->id_category == $category->id)>{{$category->category}}</option>
                           @endforeach
                        </select>
                        <select name="id_brand">
                         @foreach ($brand as $brand )
                         <option value="{{$brand->id}}" @selected($item->id_brand == $brand->id)>{{$brand->brand}}</option>
                         @endforeach
                        </select>
                        <select class="status" name="status">
                              <option value="0"  @selected($item->status == 0)>New</option>
                              <option value="1" @selected($item->status == 1)>Sale</option>
                        </select>
                        <input class="input-sale hidden" name="sale" value="{{$item->sale}}" style="width:200px" placeholder="Nhập giá sale">
                        <input type="text" placeholder="Company Profile" name="company" value="{{$item->company}}"/>
                        <input type="file" name="image[]" multiple>
                        <div style="display: flex; gap: 10px;">
                            @foreach ($image as $img)
                                <div style="text-align: center;">
                                    <img style="width: 100px; height: 80px;" src="{{ asset('upload/user/avatar/' . $img) }}" alt="Image">
                                    <br>
                                    <input type="checkbox" name="hinhxoa[]" value="{{ $img }}">
                                </div>
                            @endforeach
                        </div>
                        <textarea name="detail"  cols="30" rows="10" placeholder="Detail" value="{{$item->detail}}">{{$item->detail}}</textarea>

                        <button type="submit" class="btn btn-default">Create</button>
                    </form>
                </div>
                </div>
                </div>
            </div>
        </div>
</section>
<script>
    $(document).ready(function(){

        $('.status').change(function(){
            var status = $('.status').val();
            var sale = $('.input-sale').val();

            if(status == 1){
                $('.input-sale').removeClass('hidden');
                $('.input-sale').val(sale);
            } else {
                $('.input-sale').addClass('hidden');

            }
        });

    })
</script>

@endsection
