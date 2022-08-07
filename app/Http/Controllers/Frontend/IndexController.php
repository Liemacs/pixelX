<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();
        return view('frontend.index', compact(['banners', 'categories']));
    }

    public function termsOfUse()
    {
        return view('frontend.pages.terms-of-use');
    }

    public function frequentlyAskedQuestions()
    {
        return view('frontend.pages.faq');
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function shop(Request $request)
    {
        $products = Product::query();

        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $cat_ids = Category::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('cat_id', $cat_ids);
        }

        if (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('slug', $slugs)->pluck('id')->toArray();
            $products = $products->whereIn('brand_id', $brand_ids);
        }

        if (!empty($_GET['multiplayer'])) {
            $products = $products->where('multiplayer', $_GET['multiplayer']);
        }

        if (!empty($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'priceAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'ASC');
            } else if ($_GET['sortBy'] == 'priceDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('offer_price', 'DESC');
            } else if ($_GET['sortBy'] == 'discountAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'ASC');
            } else if ($_GET['sortBy'] == 'discountDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('price', 'DESC');
            } else if ($_GET['sortBy'] == 'titleAsc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'ASC');
            } else if ($_GET['sortBy'] == 'titleDesc') {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'DESC');
            } else {
                $products = $products->where(['status' => 'active'])->orderBy('title', 'DESC');
            }
        }
        if (!empty($_GET['price'])) {
            $price = explode("-", $_GET['price']);
            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('offer_price', $price)->where("status", "active")->paginate(12);
        } else {
            $products = $products->where("status", "active")->paginate(12);
        }
        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();
        $cats = Category::where(["status" => "active", "is_parent" => 1])->with('products')->orderBy('title', 'ASC')->get();
        // return $brands;
        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function shopFilter(Request $request)
    {
        $data = $request->all();
        //Category Filter
        $catUrl = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $category) {
                if (empty($catUrl)) {
                    $catUrl .= '&category=' . $category;
                } else {
                    $catUrl .= ',' . $category;
                }
            }
        }

        //Sort filter
        $sortByUrl = "";
        if (!empty($data['sortBy'])) {
            $sortByUrl .= '&sortBy=' . $data['sortBy'];
        }

        //price filter
        $price_range_Url = "";
        if (!empty($data['price_range'])) {
            $price_range_Url .= '&price=' . $data['price_range'];
        }

        // brand filter
        $brandUrl = "";
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $brand) {
                if (empty($brandUrl)) {
                    $brandUrl .= '&brand=' . $brand;
                } else {
                    $brandUrl .= ',' . $brand;
                }
            }
        }
        $multiplayerUrl = '';
        if (!empty($data['multiplayer'])) {
            $multiplayerUrl .= '&multiplayer=' . $data['multiplayer'];
        }

        return \redirect()->route('shop', $catUrl . $sortByUrl . $price_range_Url . $brandUrl . $multiplayerUrl);
    }

    // public function autoSearch(Request $request)
    // {
    //     $query = $request->get('term', '');
    //     $products = Product::where('title', 'LIKE', '%' . $query . '%')->get();
    //     $data = array();
    //     foreach ($products as $product) {
    //         $data[] = array('value' => $product->title, 'id' => $product->id);
    //     };
    //     if (count($data)) {
    //         return $data;
    //     } else {
    //         return ['value' => "No result found", 'id' => ''];
    //     };
    //     // dd($query);
    // }

    public function search(Request $request)
    {
        $query=$request->input('query');
        $products = Product::where('title', 'LIKE', '%' . $query . '%')->orderBy('id', 'DESC')->paginate(12);
        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();
        $cats = Category::where(["status" => "active", "is_parent" => 1])->with('products')->orderBy('title', 'ASC')->get();
        
        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function summerSale()
    {
        $products = Product::where('status', 'active')->having('discount', '>', 50)->orderBy('id', 'DESC')->paginate('12');
        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();
        $cats = Category::where(["status" => "active", "is_parent" => 1])->with('products')->orderBy('title', 'ASC')->get();
        
        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function summerNew()
    {
        $products = Product::where('status', 'active')->where('release', '>', now()->subDays(30)->endOfDay())->orderBy('id', 'DESC')->paginate('12');
        $brands = Brand::where('status', 'active')->orderBy('title', 'ASC')->with('products')->get();
        $cats = Category::where(["status" => "active", "is_parent" => 1])->with('products')->orderBy('title', 'ASC')->get();

        return view('frontend.pages.product.shop', compact('products', 'cats', 'brands'));
    }

    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with(['products'])->where('slug', $slug)->first();
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->get();
            } else if ($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->get();
            } else if ($sort == 'discountAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->get();
            } else if ($sort == 'discountDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->get();
            } else if ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->get();
            } else if ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->get();
            } else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->get();
            }
        }

        $route = 'product-category';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products']));
    }

    public function productDetail($slug)
    {
        $product = Product::with('rel_prods')->where('slug', $slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product'));
        } else {
            return 'Product detail not found';
        }
    }

    public function userAuth()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user', $request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            } else {
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        } else {
            return back()->with('error', 'Invalid email & password!');
        }
    }

    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'username' => 'nullable|string',
            'full_name' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        Session::put('user', $data['email']);
        Auth::login($check);
        if ($check) {
            return redirect()->route('home')->with('success', 'Success register');
        } else {
            return back()->with('error', 'Please check your credentials');
        }
    }

    private function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }

    public function userDashboard()
    {
        $user = Auth::user();
        return view('frontend.user.dashboard', compact('user'));
    }

    public function userOrder()
    {
        $user = Auth::user();
        return view('frontend.user.order', compact('user'));
    }

    public function userAccount()
    {
        $user = Auth::user();
        return view('frontend.user.account', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'newpassword' => 'password|min:4',
            'oldpassword' => 'password|min:4',
            'photo' => 'nullable',
            'full_name' => 'required|string',
            'username' => 'required|string',
            'phone' => 'nullable|max:12'
        ]);

        $hashpassword = Auth::user()->password;
        if ($request->oldPassword == null && $request->newPassword == null) {
            User::where('id', $id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone, 'photo' => $request->photo]);
            return back()->with('success', 'Account successfully updated');
        } else {
            if (Hash::check($request->oldPassword, $hashpassword)) {
                if (!Hash::check($request->newPassword, $hashpassword)) {
                    User::where('id', $id)->update(['full_name' => $request->full_name, 'username' => $request->username, 'phone' => $request->phone, 'photo' => $request->photo, 'password' => Hash::make($request->newPassword)]);
                    return back()->with('success', 'Account successfully updated');
                } else {
                    return back()->with('error', 'New password can not be same with old passord');
                }
            } else {
                return back()->with('error', 'Old password does not math');
            }
        }
    }
}
