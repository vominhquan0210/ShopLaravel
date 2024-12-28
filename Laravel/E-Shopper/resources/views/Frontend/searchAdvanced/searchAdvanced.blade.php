@extends('Frontend.master')
@section('noi_dung')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="features_items">
                    <h2 class="title text-center">Features Items</h2>
                    <div style="margin-bottom: 40px">
                        <form action="/search/advanded"  method="POST">
                            @csrf
                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="name" name="name">
                            </div>
                            <div class="col-sm-3">
                                <select name="price" >
                                    <option value="">Price</option>
                                    <option value="0-10000">10000</option>
                                    <option value="10000-20000">10000-20000</option>
                                    <option value="20000-30000">20000-30000</option>
                                    <option value="30000-40000">30000-40000</option>
                                    <option value="40000-50000">40000-50000</option>
                                </select>

                            </div>
                            <div class="col-sm-3">
                                <select name="id_category" id="">
                                    <option value="">Category</option>
                                    @foreach ($category as $categories)
                                <option value="{{$categories->id}}">{{$categories->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="id_brand" id="">
                                    <option value="">Brand</option>
                                    @foreach ($brand as $brands)
                                    <option value="{{$brands->id}}">{{$brands->brand}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 " style="margin-top:10px">
                                <select name="status" id="">
                                    <option value="">Status</option>
                                    <option value="0">New</option>
                                    <option value="1">Sale</option>
                                </select>
                            </div>
                            <div class="col-sm-3 " style="margin-top:10px">
                                <button class="btn btn-warning">Search</button>
                                </select>
                            </div>
                        </form>
                    </div>
                    @if (!empty($items))
                        @foreach ($items as $result)
                        <?php
                        $image = json_decode($result->image, true);
                        $firstImage = $image[0];
                        ?>
                        <div class="col-sm-4" style="margin-top : 15px">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{asset('upload/user/avatar/'.$firstImage)}}" alt="" />
                                            <h2>${{$result->price}}</h2>
                                            <p>{{$result->name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>${{$result->price}}</h2>
                                                <p>{{$result->name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach



                    @else
                    @foreach ($products as $item)
                    <?php
                    $image = json_decode($item->image, true);
                    $firstImage = $image[0];
                    ?>
                    <div class="col-sm-4" style="margin-top : 15px">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{asset('upload/user/avatar/'.$firstImage)}}" alt="" />
                                        <h2>${{$item->price}}</h2>
                                        <p>{{$item->name}}</p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$item->price}}</h2>
                                            <p>{{$item->name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="pagination-area">
                        {!! $products->links('pagination::bootstrap-4') !!}
                    </div>

                    @endif

                </div>


            </div>
        </div>
    </div>
</section>
@endsection
