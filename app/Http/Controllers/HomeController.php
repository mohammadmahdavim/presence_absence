<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profile', ['user' => $user]);
    }

    public function password(Request $request, $id)
    {

        $this->validate(request(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:6',
                'confirm_password' => 'required',
            ]
        );

        $user = User::find($id);

        if ($request->old_password || $request->new_password || $request->confirm_password) {
            if (!Hash::check($request['old_password'], $user->password)) {
                alert()->error('خطا', 'پسورد وارد شده قبلی شما نادرست است')->autoClose(5000);
                return back();
            } else {
                if ($request->new_password == $request->confirm_password) {
                    $password = Hash::make($request->new_password);
                    $user->update([
                        'password' => $password,
                    ]);
                    alert()->success('موفق', 'ویرایش شما با موفقیت ثبت گردید!');
                    return back();
                } else {
                    alert()->error('خطا', 'رمز عبور با تکرار آن مطابقت ندارد')->autoClose(5000);
                    return back();
                }
            }

        }
    }
}
