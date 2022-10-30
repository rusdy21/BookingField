<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;
use App\Models\Member;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    //
    public function create()
    {
        $field = Field::all();
        $member = Member::all();
        return view('pages.booking.new')->with([
            'field' => $field,
            'member' => $member
        ]);
    }

    public function store(Request $request)
    {
        $request->all();
        Booking::create([
        'id_member'=>$request->member,
        'id_field'=>$request->field,
        'booking_date'=>$request->BookingDate,
        'time_start'=>$request->time_start,
        'time_end'=>$request->time_finish,
        'id_user'=>$request->id_user
    ]);

    return redirect()->route('booking.index');


    }


    public function index()
    {

        $items = Booking::join('members','bookings.id_member','=','members.id_member')
                          ->join('fields','bookings.id_field','=','fields.id_field')
                        ->orderBy('id_booking','desc')
                        ->orderBy('time_start','desc')
                          ->get((['bookings.*', 'members.nama_member','fields.nama_field']));

        return view ('pages.booking.index')->with([
            'items' => $items,
            'no'=>1
        ]);
    }

    public function edit($id)
    {
        $item = Booking::where('id_booking',$id)->first();
        $field = Field::all();
        $member = Member::all();
        $date_booking = $item->booking_date;
        $field_item = $item->id_field;
       $time_start = DB::table('timeslots')->select('slot')
        ->whereNotIn('slot',function($query) use ($date_booking,$field_item,$id) {
           $query->select('time_start')->from('bookings')
           ->where('booking_date','=',$date_booking)
           ->where('id_field','=', $field_item)
           ->where('id_booking','!=',$id);

         })
         ->whereNotIn('slot',function($query2) use($date_booking,$field_item, $id){
           $query2->select('slot')->from('timeslots')
           ->join('bookings', function($join) use ($date_booking, $field_item,$id){
               $join->on('timeslots.slot','>','bookings.time_start')
                       ->on('timeslots.slot','<','bookings.time_end')
               ->where('booking_date','=',$date_booking)
               ->where('id_field','=', $field_item)
               ->where(DB::raw('time_end-time_start'),'>', 10000)
               ->where('id_booking','!=', $id);
           });


         })
         ->get();
            $time_finish="";
            $count = DB::table('bookings')->select('time_start')
                    ->where('time_start','>',$item->time_start)
                    ->where('booking_date','=',$date_booking)
                    ->where('id_field','=', $field_item)->count();

            if ($count != 'null'){
                $batas_akhir = Booking::where('time_start','>',$item->time_start)
                                ->where('booking_date','=',$date_booking)
                                ->where('id_field','=', $field_item)->first();

                $time_finish = DB::table('timeslots')->select('slot')
                                ->where('slot','>',$item->time_start)
                                ->where('slot','<=',$batas_akhir->time_start)->get();
            }
            else{
                $time_finish = DB::table('timeslots')->select('slot')
                ->where('slot','>',$item->time_start)->get();
            }


        return view('pages.booking.edit')->with(
             [
                 'item' => $item,
                 'field' => $field,
                 'member' => $member,
                 'time_start'=>$time_start,
                 'time_finish'=>$time_finish
             ]
         );
    }

    public function time_start (Request $request)
    {

       $date_booking = $request->input('BookingDate');
        $field = $request->input('Field');
        $data['time_start'] = DB::table('timeslots')->select('slot')
        ->whereNotIn('slot',function($query) use ($date_booking,$field) {
           $query->select('time_start')->from('bookings')
           ->where('booking_date','=',$date_booking)
           ->where('id_field','=', $field);

         })
         ->whereNotIn('slot',function($query2) use($date_booking,$field){
           $query2->select('slot')->from('timeslots')
           ->join('bookings', function($join) use ($date_booking, $field){
               $join->on('timeslots.slot','>','bookings.time_start')
                       ->on('timeslots.slot','<','bookings.time_end')
               ->where('booking_date','=',$date_booking)
               ->where('id_field','=', $field)
               ->where(DB::raw('time_end-time_start'),'>', 10000);
           });


         })
         ->get();


            return response()->json($data);
    }



    public function time_finish(Request $request)
    {

        $date_booking = $request->input('BookingDate');
        $time_start = $request->input('time_start');
        $field= $request->input('Field');

        $count = DB::table('bookings')->selectRaw('min(time_start) as "time-start", count(time_start)')->from('bookings')
        ->where('booking_date','=',$date_booking)
        ->where('id_field','=', $field)
        ->where('time_start','>',$time_start)->count();


        if ($count != 'null'){
                            $data['time_finish'] = DB::table('timeslots')->select('slot')
                            ->where('slot','>',$time_start)
                            ->where('slot', '<=', function($query) use ($time_start, $date_booking, $field){
                            $query->selectRaw('min(time_start) as "time-start"')->from('bookings')
                            ->where('booking_date','=',$date_booking)
                            ->where('id_field','=', $field)
                            ->where('time_start','>',$time_start);
                            })->get();
                        }
                    else{

                            $data['time_finish'] = DB::table('timeslots')->select('slot')
                            ->where('slot','>',$time_start)->get();
                    }

                    return response()->json($data);
    }


    public function destroy($id)
    {

        Booking::where('id_booking',$id)->delete();
        return redirect()->route('booking.index');

    }

    public function update(Request $request, $id)
    {
        $request->all();

        $item = Booking::where('id_booking',$id);
        $item->update([
            'id_member'=>$request->member,
            'id_field'=>$request->field,
            'booking_date'=>$request->BookingDate,
            'time_start'=>$request->time_start,
            'time_end'=>$request->time_finish,
            'id_user'=>$request->id_user
        ]);

        return redirect()->route('booking.index');
    }

    public function testquery()
    {
        //echo "Test Query";
        $waktu = (int)'09:00';
        $waktu_baru = $waktu-1;
      //  echo (string)$waktu_baru.":00";


       $data['total'] = DB::table('bookings')->select('time_start')
                ->where('id_field','=',1)
                ->where('booking_date','=','2022-10-26')
                ->where('time_start','=',(string)$waktu_baru.':00')
                ->where(DB::raw('time_end-time_start'),'>', 10000)->count();


        return response()->json($data);
    }

    public function field_status(Request $request){
        $date_booking = $request->input('BookingDate');
        $time_start = $request->input('time_start');
        $field= $request->input('Field');

        $hitung = DB::table('bookings')->select('time_start')
                ->where('id_field','=',$field)
                ->where('booking_date','=',$date_booking)
                ->where('time_start','=',$time_start)->count();

                if ($hitung > 0)
                {
                    $data['total']=1;
                }
                else{
                    $hour_ago = (int)$time_start - 1;
                    $data['total'] = DB::table('bookings')->select('time_start')
                    ->where('id_field','=',$field)
                    ->where('booking_date','=',$date_booking)
                    ->where('time_start','=',(string)$hour_ago.":00")
                    ->where(DB::raw('time_end-time_start'),'>', 10000)->count();
                }

                return response()->json($data);
    }
}
