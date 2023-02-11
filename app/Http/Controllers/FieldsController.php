<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Models\Field;
use Illuminate\Http\Request;

class FieldsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:field index', ['only' => ['index']]);
        $this->middleware('permission:field create', ['only' => ['create', 'store']]);
        $this->middleware('permission:field edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete field', ['only' => ['destroy']]);

    }

    public function index()
    {
        $items = Field::orderBy('id_field','desc')->get();

        return view ('pages.fields.index')->with([
            'items' => $items,
            'no'=>1
        ]);

    }

    public function create()
    {
        return view('pages.fields.new');
    }

    public function edit($id)
    {
        $item = Field::where('id_field',$id)->first();

        return view('pages.fields.edit')->with(
             [
                 'item' => $item
             ]
         );
    }

    public function destroy($id)
    {
        Field::where('id_field',$id)->delete();
        return redirect()->route('fields.index');
    }

    public function store(FieldRequest $request)
    {
        $request->all();
        Field::create([
        'nama_field'=>$request->nama_field,
        'price_field_per_hour'=>preg_replace("/([^0-9\\.])/i", "",$request->price_field_per_hour)
    ]);

    return redirect()->route('fields.index');


    }

    public function update(FieldRequest $request, $id)
    {
        $request->all();

        $item = Field::where('id_field',$id);
        $item->update([
            'nama_field'=>$request->nama_field,
            'price_field_per_hour'=>$request->price_field_per_hour
        ]);

        return redirect()->route('fields.index');
    }

}
