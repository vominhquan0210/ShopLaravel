@extends('Frontend.master')
@section('noi_dung')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->
        @if (session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{ session('success') }}
        </div>
        @endif
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-5">
                    <div class="shopper-info hidden" id="formRegister">
                        <p>Register</p>
                        <form  action="/create-user/register" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" placeholder="Name" name="name"/>
                            <input type="email" placeholder="Email Address" name="email"/>
                            <input type="password" placeholder="Password" name="password"/>
                            <input type="text" placeholder="Phone" name="phone">
                            <input type="text" placeholder="Address" name="address">
                            <input type="file"  name="avatar">
                            <select name="id_country">

                                @foreach ($quoc_gia as $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
        @endforeach

                            </select>

                            <button type="submit" class="btn btn-default" >Register</button>
                        </form>
                    </div>

                </div>


            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   if(session()->has('cart')){
                      $cartSession = session()->get('cart');
                      $totalPrice = 0;


                      foreach($cartSession as $value){
                        $total = $value['qty'] * $value['price'];
                        $totalPrice += $total;
                         echo '
                          <tr>
                        <td class="cart_product">
                            <a href=""><img style="width:110px ; height:110px" src="'.asset('upload/user/avatar/'.$value['image'][0]).'" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">'.$value['name'].'</a></h4>
                            <p>Web ID:'.$value['id'].'</p>
                        </td>
                        <td class="cart_price">
                            <p>$'.$value['price'].'</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up"  id='.$value['id'].'> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="'.$value['qty'].'" autocomplete="off" size="2">
                                <a class="cart_quantity_down" id='.$value['id'].'> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$'.$total.'</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" id='.$value['id'].'><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                         ';
                      }
                   } else {
                    echo 'Chưa có sản phẩm nào';
                   }
                    ?>

                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$59</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$2</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <?php
                                    if (isset($totalPrice)) {
                                        echo '<td><span class="total_price">' . $totalPrice . '</span></td>';
                                    } else {
                                        echo '<td><span class="total_price">0</span></td>';
                                    }
                                ?>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div>
                <form method="POST" action="/checkout">
                    @csrf
                    <button type="submit" class="btn btn-primary">Continue</button>
                    </form>
            </div>


        </div>



        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section>

 <script>
    $(document).ready(function(){

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

       var checkLogin = "{{Auth::check()}}"

       if(checkLogin){
          $('#formRegister').addClass('hidden');
       } else {
        $('#formRegister').removeClass('hidden');
       }

       $('.cart_quantity_up').click(function() {
                var row = $(this).closest('tr');
                var idPlus = $(this).attr('id');

                $.ajax({
                    type: "POST",
                    url: '/ajax/cart/qtyup',
                    data: {
                        idPlus: idPlus,
                    },
                    success: function(data) {
                        row.find('.cart_quantity_input').val(data.newQty);
                        var price = row.find('.cart_price p').text().replace('$', '');

                        var total = price * data.newQty;

                        row.find('.cart_total_price').text('$' + total);

                   $('.total_price').text(data.totalPrice)

                    },
                    error: function(xhr, status, error) {
                        console.error("Lỗi:", xhr.responseText);
                    }
                });
            })

            $('.cart_quantity_down').click(function(){
               var row = $(this).closest('tr');
               var idMinus = $(this).attr('id');

               $.ajax({
                  type:"POST",
                  url : "/ajax/cart/qtydown",
                  data : {
                    idMinus : idMinus
                  },
                  success:function(data){
                    console.log(data);
                    row.find('.cart_quantity_input').val(data.newQty);

                   var price = row.find('.cart_price p').text().replace('$' , '');

                   var total = price * data.newQty;

                   row.find('.cart_total_price').text('$' + total);

                   $('.total_price').text(data.totalPrice)

                  }


               })
            })

            $('.cart_quantity_delete').click(function(){
                 var row = $(this).closest('tr');
                var idDelete = $(this).attr('id');

                $.ajax({
                    type: "POST",
                    url : '/ajax/cart/delete',
                    data : {
                       idDelete : idDelete
                    },

                    success:function(data){
                        row.remove();

                        $('.total_price').text(data.totalPrice + '$');
                    }
                })
            })
    })
 </script>
@endsection
