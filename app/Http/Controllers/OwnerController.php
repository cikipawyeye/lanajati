<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;
use App\Models\Settings;
use App\User;
use App\Rules\MatchOldPassword;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth as FacadesAuth;

/**
 * Handles various administrative actions in the application.
 *
 * This controller class provides methods for managing user profiles, settings, and password changes.
 *
 * @package App\Http\Controllers
 */
class OwnerController extends Controller
{
    /**
     * Show the dashboard for the owner.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data = User::select(
            DB::raw("COUNT(*) as count"), 
            DB::raw("DAYNAME(created_at) as day_name"), 
            DB::raw("DAY(created_at) as day")
        )
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->groupBy('day_name', 'day')
        ->orderBy('day')
        ->get();

        $array[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }
        return view('owner.index')->with('users', json_encode($array));
    }
    public function pesananIndex()
    {
        $orders = Order::orderBy('id', 'ASC')->paginate(10);
        return view('owner.pesanan.index')->with('orders', $orders);
    }
    public function pesananShow($id)
    {
        $order = Order::findOrFail($id);
        return view('owner.pesanan.show')->with('order', $order);
    }
    
    /**
     * Membuat PDF dari pesanan dengan ID tertentu
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pdf($id)
    {
        $order = Order::findOrFail($id);
        
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('owner.pesanan.pdf', ['pesanan' => $order]);
        
        return $pdf->download('pesanan_'.$order->id.'_'.$order->created_at.'.pdf');
    }
    
    /**
     * Show the profile page for the owner.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $profile = FacadesAuth::user();
        return view('owner.users.profile')->with('profile', $profile);
    }

    /**
     * Update the profile for the owner.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        $status = $user->fill($data)->save();

        if ($status) {
            $request->session()->flash('success', 'Successfully updated your profile');
        } else {
            $request->session()->flash('error', 'Please try again!');
        }

        return redirect()->back();
    }

    /**
     * Show the settings page for the owner.
     *
     * @return \Illuminate\View\View
     */
    public function pengaturan()
    {
        $data = Settings::first();
        return view('owner.pengaturan')->with('data', $data);
    }

    /**
     * Update the settings for the owner.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pengaturanUpdate(Request $request)
    {
        $this->validate($request, [
            'short_des' => 'required|string',
            'description' => 'required|string',
            'photo' => 'required',
            'logo' => 'required',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $data = $request->all();
        $settings = Settings::first();
        $status = $settings->fill($data)->save();
        if ($status) {
            $request->session()->flash('success', 'Setting successfully updated');
        } else {
            $request->session()->flash('error', 'Please try again');
        }
        return redirect()->route('owner.pengaturan');
    }
    /**
     * Show the user pie chart data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function userPieChart(Request $request)
    {
        $data = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name', 'day')
            ->orderBy('day')
            ->get();

        $array[] = ['Name', 'Number'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->day_name, $value->count];
        }

        return view('owner.user.index')->with('course', json_encode($array));
    }
    public function salesReportPayment(request $request)
    {
        $query = Order::where('payment_status', 'paid');

        if ($request->start_date && $request->end_date) {
            $start_date = date('Y-m-d 00:00:00', strtotime($request->start_date));
            $end_date = date('Y-m-d 23:59:59', strtotime($request->end_date));
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }
        $orders = $query->get();
        return view('owner.salesreport.payment', compact('exports', 'orders'));
    }

    public function orderp(Request $request)
    {
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $orders = Order::where('status', 'delivered')
            ->when($start_date, function ($query, $start_date) {
                return $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date, function ($query, $end_date) {
                return $query->whereDate('created_at', '<=', $end_date);
            })
            ->get();
        $orders = Order::with('cart.product')->get();
        return view('owner.salesreport.orderp', compact('orders'));
    }
    public function reportstock(Request $request)
    {
        $query = Product::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $products = $query->with('category')->select('id', 'title', 'cat_id', 'slug','discount','price','stock')->get();
        $categories = Category::where('is_parent', 1)->get();
       
        return view('owner.salesreport.stock', compact('products', 'categories'));
    }
    public function exportPDF(Request $request)
    {
        $query = Product::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        $products = $query->with('category')->select('id', 'title', 'cat_id', 'slug','discount','price','stock')->get();
        
        $pdf = PDF::loadView('owner.salesreport.export-pdf', compact('products'));
        return $pdf->download('laporan-stok-produk.pdf');
    }
    public function productReview()
    {
        $reviews=ProductReview::getAllReview();
        
        return view('owner.review.index')->with('reviews',$reviews);
    }
    
    public function userIndex()
    {
        $users = User::orderBy('id','ASC')->paginate(10);
        return view('owner.users.index')->with('users', $users);
    }

    public function userCreate()
    {
        return view('owner.users.create');
    }
    public function useredit($id)
    {
        $user=User::findOrFail($id);
        return view('owner.users.edit')->with('users',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userupdate(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $this->validate($request,
        [
            'name'=>'string|required|max:30',
            'email'=>'string|required',
            'role'=>'required|in:admin,user,owner',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);
        // dd($request->all());
        $data=$request->all();
        // dd($data);
        
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated');
        }
        else{
            request()->session()->flash('error','Error occured while updating');
        }
        return redirect()->route('owner.users.index');
    }
}