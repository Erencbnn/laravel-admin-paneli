<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // User modelini ekledik
use Illuminate\Support\Facades\Hash; // Hash kullanımı için ekledik

class MemberController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email','password');
        if (auth()->attempt($credentials)) {
            return redirect(route('admin.index'));
        }

        return redirect()->back()->withErrors(
            ['login' =>'Giriş bilgileri hatalı']
        );
    }

    public function logout(){
       auth()->logout();

       return redirect(route('admin.login'));
    }

    public function register(Request $request) {

        $data = $request->only('name','surname','email','password','repassword');
        //dd($data);

       if($data['password'] !==$data['repassword']){
        $message = ['type' => 'danger','description'=>'Parolarar eşleşmedi'];
        return redirect()->back()->withInput()->with(['message'=>$message]);

       }


        User::create(
            [
                'name'=> $data['name'] . ' ' . $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // bcrypt yerine Hash::make() kullanıldı
            ]
        );
        $message = ['type' => 'success','description'=>'Kayıt işlemi başarılı.Girişi yapabilirsiniz.'];
        return redirect (route('admin.login'))->with(['message'=>$message]);
    }
}
