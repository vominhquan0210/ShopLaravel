@extends('Frontend.master')
@section('noi_dung')
<section>
    <div class="container">
        <div class="row">
            @include('Frontend.Layout.left-sidebar-account')
            <div class="col-sm-9">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Image</td>
                                <td class="description">Name</td>
                                <td class="price">Price</td>

                                <td class="total">Action</td>

                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($product as $product)
                         <?php
                        $image = json_decode($product->image, true);
                        $firstImage = $image[0];
                         ?>
                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width:120px; height:80px" src="{{asset('upload/user/avatar/'.$firstImage) }}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$product->name}}</a></h4>

                            </td>
                            <td class="cart_price">
                                <p>${{$product->price}}</p>
                            </td>

                            <td class="cart_total">
                                <a href="/update/product/{{$product->id}}"><button class="btn btn-warning">Update</button></a>
                                <a><button class="btn btn-danger">Delete</button></a>
                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

