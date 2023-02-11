<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Field;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
//use DB;


class CustomAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:user index', ['only' => ['index']]);
        $this->middleware('permission:user create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

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
            $field = Field::all();
            $jml_field = Field::all()->count();
            return view('pages.dashboard')->with(
                ['field' => $field,
                 'no'=>1,
                 'jml_field'=>$jml_field,
                 'id_img'=>1
            ]);
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

    public function getGraph(){
        $firstDay = date('Y-m-d', strtotime("this week"));
        $endDay = date('Y-m-d', strtotime($firstDay. '+ 6 days'));
        $data =DB::table('bookings')->select('booking_date',DB::raw('sum(price_field_per_hour * (time_end-time_start)/10000) as totalp') )->from('bookings')
                        ->leftjoin('fields','bookings.id_field','=','fields.id_field')
                        ->where('bookings.booking_date','>=',$firstDay)
                        ->where('bookings.booking_date','<=',$endDay)
                        ->groupBy('booking_date')->get();

        return response()->json($data);

    }

    public function nextBooking(){
        $currentDay = date('Y-m-d');
        $currentTime = date('H:i:s');
        $nextBook = Booking::join('members','bookings.id_member','=','members.id_member')
        ->join('fields','bookings.id_field','=','fields.id_field')
        ->where('bookings.booking_date',$currentDay)
        ->where('time_start','>',$currentTime)
        ->orderBy('id_booking','desc')
        ->orderBy('time_start','desc')
        ->get((['bookings.*', 'members.nama_member','fields.nama_field']));

        return response()->json($nextBook);
    }



}
