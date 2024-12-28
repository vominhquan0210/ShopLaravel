<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rate;
use App\Models\ShopeeBlog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Table;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $product = DB::table('products')->orderBy('created_at' , 'desc')->limit(6)->get();



        return view('Frontend.User.index',['showSidebar' => true],compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function register()
    {
        $quoc_gia = DB::table('countries')->get();


        $country = DB::table('users')
                ->join('countries','users.id_country','=','countries.id')
                ->select('users.*','countries.name as country_name')
                ->get();



       return view("Frontend.User.Register" , ['showSidebar' => true],compact('country','quoc_gia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $file = $request->avatar;

        $data['level'] = 0;



        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        if($data['password']){
           $data['password'] = bcrypt($data['password']);
        }

        if(User::create($data)){

            if (!empty($file)) {
                $file->move('upload/user/avatar', $file->getClientOriginalName());
            }

            $login =[
                'email' => $request->email,
                'password' => $request->password,
                // 'level' => 0
             ];


             if(Auth::attempt($login)){
                return redirect()->back()->with('success', __('Register user success.'));

             }


        }
    }


    public function login()
    {
        return view('Frontend.User.Login',['showSidebar' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function checkLogin(Request $request){
             $login =[
                'email' => $request->email,
                'password' => $request->password,
                // 'level' => 0
             ];

             $remember = false;

             if($request->remember_me){
                $remember = true;
             }

             if(Auth::attempt($login,$remember)){
                return redirect('/user');
             } else {
                return redirect()->back()->withErrors('Email or password is not correct.');
             }
    }

    public function logout(){

        Auth::logout();

        if(session()->has('cart')){

            session()->forget('cart');

        }

        return redirect('/user/login');
    }



    public function searchProduct(Request $request){
        $item = DB::table('products')->where('name','LIKE', '%'.$request->search.'%')->get();

         return view('Frontend.User.index', ['showSidebar' => true], compact('item'));

        }


   public function searchAdvanced(){


      $category = DB::table('categories')->get();

      $brand = DB::table('brands')->get();

      $products = Product::paginate(6);

      return view('Frontend.searchAdvanced.searchAdvanced',['showSidebar' => true],compact('category', 'brand' ,'products'));
   }

   public function resultsearchAdvanced(Request $request){

    $data = $request->all();

    $q = Product::query();

    $category = Category::all();
    $brand = Brand::all();

    $items = [];

    if(!empty($data['name'])){
        $q->where('name', 'LIKE' , '%'.$data['name'].'%');
    }

    if(!empty($data['price'])){
         $price = $data['price'];
        [$minPrice , $maxPrice] = explode('-', $price);

       $q->whereBetween('price',[$minPrice, $maxPrice]);

    }

    if(!empty($data['id_category'])){
       $q->where('id_category', '=',$data['id_category']);


    }

    if(!empty($data['id_brand'])){
        $q->where('id_brand', '=',$data['id_brand']);
     }

     if(!empty($data['status'])){
        $q->where('status', '=',$data['status']);
     }


    $items = $q->orderBy('created_at','DESC')->get();


    return view('Frontend.searchAdvanced.searchAdvanced',['showSidebar' => true],compact('items','category','brand'));
   }




}
