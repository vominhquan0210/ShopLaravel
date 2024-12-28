<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Country;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function product(string $id)
    {
        $product = DB::table('products')->where('id_user', $id)->get();

        // foreach ($product as $product) {
        //        $image = json_decode($product->image, true);
        //        $firstImage = $image[0];
        // }


        return view('Frontend.Product.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = DB::table('categories')->get();
        $brand = DB::table('brands')->get();
        return view('Frontend.Product.createProduct', compact('category', 'brand'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = DB::table('products')->where('id', $id)->first();


        $category = DB::table('categories')->get();

        $brand = DB::table('brands')->get();


        return view('Frontend.Product.editProduct', compact('item', 'category', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $products = Product::find($id);
        $userdecode = json_decode($products->image, true);

        $hinhxoa = $request->hinhxoa;

        if (!empty($hinhxoa)) {
            foreach ($userdecode as $key => $value) {
                if (in_array($value, $hinhxoa)) {
                    unset($userdecode[$key]);
                }
            }
        }

        $new = array_values($userdecode);
        $data['image'] = json_encode($new);

        if ($request->hasFile('image')) {
            $picture = $this->handleUploadedImages($request->file('image'));
            $allArray = array_merge($picture, $new);

            if (count($allArray) > 3) {
                return redirect()->back()->withErrors('Số lượng phải nhỏ hơn 3');
            }

            $data['image'] = json_encode($allArray);
        }

        if ($products->update($data)) {
            return redirect()->back()->with('success', __('Update product successfully'));
        } else {
            return redirect()->back()->withErrors('Error updating product');
        }
    }


    public function productDetail($id){



        $productDetail = DB::table('products')
                         ->join('brands', 'products.id_brand', '=' , 'brands.id')
                          ->select('products.*', 'brands.brand')
                          -> where('products.id', $id) -> first();

        return view('Frontend.Product.productDetail', ['showSidebar' => true], compact('productDetail'));
    }

    public function cart(Request $request)
{
    if ($request->idParent) {
        $idParent = $request->idParent;

        $cart = DB::table('products')->where('id', $idParent)->first();



        $data = [
            'id' => $cart->id,
            'name' => $cart->name,
            'price' => $cart->price,
            'image' => json_decode($cart->image, true),
            'detail' => $cart->detail,
            'qty' => 1
        ];

        $found = false;
        $getSession = session()->get('cart');



        if(session()->has('cart')){

            foreach($getSession as $key => $value){

                if($value['id'] == $idParent){
                    $getSession[$key]['qty'] +=1;
                    $found = true;
        session()->put('cart', $getSession);
                    break;
                }
            }

        }

        if (!$found){
            $getSession[] = $data;
        }

        session()->put('cart', $getSession);


        $totalQty = 0;

        foreach($getSession as $value){
            $totalQty += $value['qty'];
        }


        return response()->json([
            'success' => true,
            'product' => $data,
            'totalQty' => $totalQty,

        ]);
    }
}

     public function Qty(){
        $totalQty = 0;
        $qtySession = session()->get('cart');

        if(session()->has('cart')){
            foreach($qtySession as $value){
                $totalQty += $value['qty'];
            }
        }

        return response()->json([
            'totalQty' => $totalQty,
        ]);
     }

     public function cartIndex(){
        return view('Frontend.Cart.cart');
     }

     public function qtyUp(Request $request){
        if($request->idPlus){
           $idPlus = $request->idPlus;
           $plusSession = session()->get('cart');

           if(session()->has('cart')){
               foreach($plusSession as $key => $value){
                if($value['id'] == $idPlus){
                    $plusSession[$key]['qty'] +=1;
                    break;
                }

               }
           }

           session()->put('cart',$plusSession);

           $totalPrice = 0;
           $newQty = 0;


           foreach($plusSession as $value){
              $totalPrice += $value['qty'] * $value['price'];
               if($value['id'] == $idPlus){
                  $newQty = $value['qty'];
               }
           }



        }

        return response()->json([
            'totalPrice' => $totalPrice,
            'newQty' => $newQty,
           ]);
     }

     public function qtyDown(Request $request){
        if($request->idMinus){
            $idMinus = $request->idMinus;

            if(session()->has('cart')){
                $minusSession = session()->get('cart');

                foreach ($minusSession as $key => $value){
                    if($value['id'] == $idMinus){
                       if($minusSession[$key]['qty'] > 1){
                        $minusSession[$key]['qty'] -=1 ;
                       }
                       break;
                    }
                }

                session()->put('cart',$minusSession);

                $newQty = 0;
                $totalPrice = 0;

                foreach($minusSession as $value){
                    $totalPrice += $value['qty'] * $value['price'];

                    if($value['id'] == $idMinus){
                        $newQty = $value['qty'];
                    }
                }
            }
        }

        return response()->json([
           'idMinus' => $idMinus,
           'totalPrice' => $totalPrice,
           'newQty' => $newQty
        ]);
     }

     public function qtyDelete(Request $request){

        if($request->idDelete){
            $idDelete = $request->idDelete;

            if(session()->has('cart')){
                $deleteSession = session()->get('cart');

                foreach($deleteSession as $key => $value){
                    if($value['id'] == $idDelete){
                        unset($deleteSession[$key]);
                        break;
                    }
                }

                session()->put('cart',$deleteSession);

                $totalPrice = 0;

                foreach($deleteSession as $value){
                    $totalPrice += $value['price'] * $value['qty'];
                }


            }

        }

        return response()->json([
            'idDelete' => $idDelete,
            'totalPrice' => $totalPrice
        ]);
     }


     public function checkout(){

        $quoc_gia = Country::get();
        return view('Frontend.Product.checkOut' , compact('quoc_gia'));

     }

     public function order(Request $request){

        $idUser = Auth::id();

        $user = User::findOrFail($idUser);

        if(session()->has('cart')){
            $cartSession = session()->get('cart');
            $totalPrice = 0;


            foreach($cartSession as $value){
              $total = $value['qty'] * $value['price'];
              $totalPrice += $total;

            }
         };


        DB::table('histories')->insert([
            [
                   'email' => $user->email,
                   'phone' => $user->phone,
                   'name' => $user->name,
                   'price' => $totalPrice,
                   'id_user' => $idUser,
                   'created_at' => now(),
                   'updated_at' => now()
            ]
            ]);

     return redirect()->back()->with('success', __('Register user success.'));
     }

     public function sliderPrice(Request $request){
        if ($request->has('minPrice') && $request->has('maxPrice')) {


            $min = (int)$request->minPrice;

            $max = (int)$request->maxPrice;

            $slide = Product::orderBy('price','ASC')->whereBetween('price',[$min, $max])->limit(4)->get();


        }

        return response()->json([
            'success' => true,
            'minPrice' => $min,
            'maxPrice' => $max,
            'slide' => $slide

        ]);
     }

}
