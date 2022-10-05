<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;


class CustomAuthController extends Controller
{
    public function index()
    {
        $items = User::all();

        return view ('pages.users.index')->with([
            'items' => $items,
            'no'=>1
        ]);
    }

    public function customLogin(Request $request)
    {
        $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
            ]
            );
        // set the remember me cookie if the user check the box
         $remember = $request->has('remember') ? true : false;

        if(Auth::attempt(['email' => $request->email,
        'password' => $request->password], $remember)){
            return redirect()->intended('/')->withSuccess('Signed in');
        }

        return redirect('login')->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }



    public function store(UserRequest $request)
    {

        $request->all();
        User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password)
      ]);

      return redirect()->route('users.index');
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function to_login(){
        return view('pages.login');
    }

    public  function create(){
        return view ('pages.users.new');
    }

    public function edit($id)
    {
        $item = User::findOrfail($id);

        return view('pages.users.edit')->with(
             [
                 'item' => $item
             ]
         );
    }

    public function update(UserRequest $request, $id)
    {
       $request->all();
        $item = User::where('id',$id);
        $item->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

       return redirect()->route('users.index');

    }

    public function destroy($id)
    {
        User::findOrfail($id)->delete();
        return redirect()->route('users.index');
    }

    public function getData(Request $request){
        $data = User::select("id","name")
                ->where("name","LIKE","%{$request->term}%")->get();
        return response()->json($data);
    }


}
