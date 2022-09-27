<?php

namespace App\Http\Controllers\Client;

use App\Jobs\SendMail;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShoppingController extends Controller
{
    public function index() {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $categoriesProduct = Category::with(['productForCategory', 'child1', 'child1.productForCategory1'])
            ->whereHas('child1.productForCategory1', function($q) {
                $q->whereNotNull('avatar1');
            })->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $isIndex = true;
        return view('client.shopping.index', compact('categories', 'categoriesProduct', 'isIndex'));
    }

    public function search(Request $request) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $search = $request->search;
        $isSearch = true;
        $products = Product::with('category','category1','category2')->where('name', 'like', '%' . $search . '%')->paginate(15);
        $products->appends(['search' => $search]);
        return view('client.shopping.search', compact('categories', 'isSearch', 'search'))->with('data', $products);
    }

    public function category($category) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $categoryPage = Category::where('link', '=', $category)->with('child1', 'child2', 'child1.child2', 'child2.product', 'child1.child2.product', 'parent1')->first();
        return view('client.shopping.category', compact('categoryPage', 'categories'));
    }

    public function category1($category, $category1) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $categoryPage = Category::where('link', '=', $category1)->with('child1', 'child2', 'child1.child2', 'child2.product', 'child1.child2.product', 'parent1')->first();
        return view('client.shopping.category', compact('categoryPage', 'categories'));
    }

    public function category2($category, $category1, $category2) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $categoryPage = Category::where('link', '=', $category2)->with('child1', 'child2', 'child1.child2', 'child2.product', 'child1.child2.product', 'parent1', 'parent2', 'product')->first();
        $products = Product::with('category2')->whereHas('category2', function ($q) use ($category2) {
            $q->where('link', $category2);
        })->paginate(15);
        return view('client.shopping.category', compact('categoryPage', 'categories'))->with('products', $products);
    }

    public function product($category, $category1, $category2, $product) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        $categoryPage = Category::where('link', '=', $category2)->with('child1', 'child2', 'child1.child2', 'child2.product', 'child1.child2.product', 'parent1', 'parent2', 'product')->first();
        $productCategoryTop = Product::where('link', '=', $product)->with('category2')->first();
        return view('client.shopping.product', compact('categoryPage', 'categories', 'productCategoryTop'));
    }

    public function cartStep1(Request $request) {
        $cart = $request->session()->get('carts');
        $step1 = true;
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        return view('client.shopping.cart.step1', compact('categories', 'cart', 'step1'));
    }

    public function cartStep2(Request $request) {
        $cart = $request->session()->get('carts');
        $step2 = true;
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        return view('client.shopping.cart.step2', compact( 'categories', 'cart', 'step2'));
    }

    public function cartStep3(Request $request) {
        $rules = [
            'name' => 'required|max:50',
            'phone' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
        ];

        $messages = [
            'name.required' => 'Tên khách hàng không được để trống',
            'name.max' => 'Tên khách hàng không được quá 50 chữ',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là số',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email phải thuộc định dạng email@mail.com',
            'address.required' => 'Địa chỉ không được để trống',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            $customer = Customer::create($data);

            $username = substr($request->email, 0, strpos($request->email, '@'));

            $userDetail = [
                'email' => $request->email,
                'username' => $username,
                'name' => $request->name,
                'password' => Hash::make(123456),
                'group' => 3,
                'active' => 1
            ];
            $checkUser = User::where('email', $request->email)->first();
            if (empty($checkUser)) {
               $user = User::create($userDetail);
            } else {
                $user = $checkUser;
            }
            $order = Order::create([
                'customer_id' => $customer->id,
                'user_id' => $user['id'],
                'price' => $request->session()->get('price'),
            ]);

            $carts = $request->session()->get('carts');
            foreach ($carts as $key => $cart) {
                OrderProduct::create([
                    'product_id' => $cart->id,
                    'order_id' => $order->id,
                    'count' => $cart['countCart'],
                    'product_price' => $cart->price_applied == 1 ? $cart->unit_price : $cart->promotion_price
                ]);
            }
            if(!empty($user)) {
                dispatch(new SendMail
                (
                    2,
                    [
                        'to' => $request->email,
                    ],
                    [
                        'name'=>$user['name'],
                        'username'=>$user['username'],
                    ]
                ));
            } else {
                dispatch(new SendMail
                (
                    3,
                    [
                        'to' => $request->email,
                    ],
                    [
                        'name'=>$request->name,
                    ]
                ));
            }

            /* ---------- Send activation mail } ---------- */

            $request->session()->forget('carts');
            $request->session()->forget('price');
            $request->session()->forget('total');
            return redirect()->route('client.cart4');
        }
    }

    public function cartStep4(Request $request) {
        $categories = Category::with('child1', 'child1.child2')->whereNull(['parent_id_1', 'parent_id_2'])->get();
        return view('client.shopping.cart.step3', compact('categories'));
    }
}
