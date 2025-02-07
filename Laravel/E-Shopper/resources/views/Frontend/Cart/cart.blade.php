@extends('Frontend.master')
@section('noi_dung')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
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
                        if (session()->has('cart')) {
                            $item = session()->get('cart');
                            $totalPrice = 0;

                            foreach ($item as $value) {
                                $total = $value['qty'] * $value['price'];

                                $totalPrice += $total;

                                echo '
                                                     <tr>
                                                <td class="cart_product">
                                                  <a href=""><img src="' .
                                    asset('upload/user/avatar/' . $value['image'][0]) .
                                    '" alt="" style="width:100px; height:80px"></a>
                                                </td>
                                                <td class="cart_description">
                                                    <h4><a href="">' .
                                    $value['name'] .
                                    '</h4>
                                                    <p>Web ID: ' .
                                    $value['id'] .
                                    '</p>
                                                </td>
                                                <td class="cart_price">
                                                    <p>$' .
                                    $value['price'] .
                                    '</p>
                                                </td>
                                                <td class="cart_quantity">
                                                    <div class="cart_quantity_button">
                                                        <a class="cart_quantity_up" id=' .
                                    $value['id'] .
                                    '> + </a>
                                                        <input class="cart_quantity_input" type="text" name="quantity"  value=' .
                                    $value['qty'] .
                                    ' autocomplete="off" size="2">
                                                        <a class="cart_quantity_down" id='.$value['id'].'> - </a>
                                                    </div>
                                                </td>
                                                <td class="cart_total">
                                                    <p class="cart_total_price">' .
                                    $total .
                                    '</p>
                                                </td>
                                                <td class="cart_delete">
                                                    <a class="cart_quantity_delete" id='.$value['id'].'><i class="fa fa-times"></i></a>
                                                </td>
                                            </tr>

                                                  ';
                            }
                        }
                        ?>


                    </tbody>
                </table>
            </div>
        </div>
    </section> <!--/#cart_items-->

    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                    delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span class="total_price"><?php echo $totalPrice?></span></li>
                        </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="/checkout">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action-->

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
