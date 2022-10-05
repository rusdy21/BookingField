<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $items = Member::all();

        return view ('pages.member')->with([
            'items' => $items,
            'no'=>1
        ]);
       // return view('pages.member');
    }

    public function create()
    {
        return view('pages.new-member');
    }

    public  function store(MemberRequest  $request)
    {
       $request->all();
       Member::create([
        'nama_member'=>$request->namaMember,
        'hp_member'=>$request->nomorHandphone,
        'alamat_member'=>$request->alamatMember
    ]);

    return redirect()->route('member.index');

    }

    public function destroy($id)
    {



        Member::where('id_member',$id)->delete();


        return redirect()->route('member.index');

    }

    public function edit($id)
    {
        $item = Member::where('id_member',$id)->first();

       return view('pages.edit-member')->with(
            [
                'item' => $item
            ]
        );

    }

    public function update(MemberRequest $request, $id)
    {
        $request->all();

        $item = Member::where('id_member',$id);
        $item->update([
            'nama_member'=>$request->namaMember,
            'hp_member'=>$request->nomorHandphone,
            'alamat_member'=>$request->alamatMember
        ]);

        return redirect()->route('member.index');
    }

}
