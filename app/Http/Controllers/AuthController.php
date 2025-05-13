<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Image;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use DB;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('front.login');
    }

    public function login(Request $request)
{
    $bestSellingProduct = Order::groupBy('product_id')
    ->selectRaw('product_id, COUNT(*) as totalSold')
    ->orderByDesc('totalSold')
    ->with(['product' => function ($query) {
        $query->with('image');
    }])
    ->first();

    $bestSellingCategory = Order::join('Products', 'Orders.product_id', '=', 'Products.product_id')
    ->groupBy('Products.category_id')
    ->selectRaw('Products.category_id, COUNT(*) as totalSold')
    ->orderByDesc('totalSold')
    ->with('category')
    ->first();

    $ordersByDate = Order::select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) as order_count'))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $credentials = $request->only('employee_id', 'password');
    $employee = Employee::where('employee_id', $credentials['employee_id'])
        ->where('password', $credentials['password'])
        ->first();

    if ($employee) {
        // Giriş başarılı
        Auth::login($employee);
        $fullName = $employee->employee_name . " " . substr($employee->employee_surname, 0, 1) . ".";
        $n = $employee->employee_name . " " . $employee->employee_surname;

        $image = Image::where('image_id', $employee->image_id)->first();
        $imageLink = $image->image_link;
        $departmentId= $employee->department_id;
        $employee_id = $employee->employee_id;
        $phone_number=$employee->phone_number;
        $password=$employee->password;

        // Session'a bilgileri kaydet
        session(['fullName' => $fullName, 'imageLink' => $imageLink,'n'=>$n,
        'department_id'=>$departmentId,'employee_id'=>$employee_id,'phone_number'=>$phone_number,'password'=>$password]);
        $pageName = 'Dashboard';

        return view('front.dashboard', compact('fullName', 'imageLink','bestSellingProduct','bestSellingCategory','pageName','ordersByDate'));
    }

    // Giriş başarısız


    return redirect()->route('login')->with('error', 'Login failed. Please check your details.');
}



public function viewDashboard(){
    $bestSellingProduct = Order::groupBy('product_id')
    ->selectRaw('product_id, COUNT(*) as totalSold')
    ->orderByDesc('totalSold')
    ->with(['product' => function ($query) {
        $query->with('image');
    }])
    ->first();

    $bestSellingCategory = Order::join('Products', 'Orders.product_id', '=', 'Products.product_id')
    ->groupBy('Products.category_id')
    ->selectRaw('Products.category_id, COUNT(*) as totalSold')
    ->orderByDesc('totalSold')
    ->with('category')
    ->first();

    $ordersByDate = Order::select(DB::raw('DATE(order_date) as date'), DB::raw('COUNT(*) as order_count'))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    $fullName = session('fullName');
    $imageLink = session('imageLink');
    $pageName = 'Dashboard';

    return view('front.dashboard', compact('fullName', 'imageLink','bestSellingProduct','bestSellingCategory','pageName','ordersByDate'));
}
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewProfile(){

        $fullName = session('fullName');
        $n = session('n');

        $imageLink = session('imageLink');
        $pageName = 'Profile';
        $departmentId= session('department_id');
        $department = Department::where('department_id',$departmentId)->first();
        $employee_id =  session('employee_id');
        $phone_number = session('phone_number');
        $employees = Employee::with('image', 'department')
        ->orderBy('employee_id', 'desc')
        ->get();

        $password= session('password');
        return view('front.profile',compact('fullName','imageLink','n','pageName','department','employee_id','phone_number','password','employees'));
    }

    public function changeSalary($id, Request $request)
{

    $employee = Employee::where('employee_id',$id)->first();
    $employee->salary = $request->input('newSalary');
    $employee->save();


    return redirect()->back()->with('success', 'Salary updated successfully');
}
    public function changePassword(Request $request)
    {



        $request->validate([

            'currentPassword' => 'required',
            'newPassword' => 'required|min:4',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $employee_id= session('employee_id');
        $user = Employee::where('employee_id',$employee_id)->first();

        // Mevcut şifre doğrulaması // if you don't log off after you change your password, you can't change it one more time, it gets old password to change it
        if ($request->currentPassword!=session('password')) {
            return redirect()->route('profile')->with('error', 'Mevcut şifre yanlış.');
        }

        // Yeni şifreyi güncelle
        $user->update([
            'password' => ($request->input('newPassword')),
        ]);

        return redirect()->route('profile')->with('success', 'Şifre başarıyla değiştirildi.');
    }


//     public function __construct()
// {
//     $this->middleware('auth');
// }

}
