<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return view('admin.profile.profile-update',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'old_password'=> 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = User::findOrFail($id);

        if(Hash::check($request->old_password, $user->password))
        {
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->get('password')){
                if(Hash::check($request->password, $user->password))
                {
                    Toastr::error('New password must be different from old.', 'Error');
                    return redirect()->back();
                }else{
                    $user->password=bcrypt($request->get('password'));
                }
            }
            $user->update();
            Toastr::success('Profile Updated Successfully!.', 'Success');
            return redirect()->back();
        }

        Toastr::error('Sorry your old password does not match!!', 'Error');
        return redirect()->back();
    }

    public function lprDate(){
        $date = Carbon::parse(\request()->dob)->addYear(59)->subDays(1)->format('d-m-Y');
//        $lpr_date = Carbon::parse($date)->format('d/m/Y');
//        dump(\Log::info(print_r($date,true)));
        return $data = [
            'lpr_date' => $date,
        ];
    }
}
