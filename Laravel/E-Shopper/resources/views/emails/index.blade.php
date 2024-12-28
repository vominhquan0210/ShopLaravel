<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (isset($data['body']))
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

                  $totalPrice = 0;


                  foreach($data['body'] as $value){
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
    </div>
    @endif

</body>
</html>
