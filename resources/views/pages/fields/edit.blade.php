@extends('layouts.index')

@section('content')
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Fields</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{route('fields.update',$item->id_field)}}" class="user" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="namaMember">Field Name</label>
                                </div>
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('nama_field') is-invalid

                                    @enderror" id="nama_field" name="nama_field" value="{{ old ('nama_field') ? old ('nama_field') : $item->nama_field}}">
                                    @error('nama_field')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="nomorHandphone">Harga Per Jam</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('price_field_per_hour') is-invalid

                                    @enderror" id="price_field_per_hour" name="price_field_per_hour" value="{{ old ('price_field_per_hour') ? old ('price_field_per_hour') : $item->price_field_per_hour}}">
                                </div>
                                @error('price_field_per_hour')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 col-form-label">

                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <button class="btn btn-info ml-5" type="submit">
                                        <span class="text">Simpan</span>
                                    </button>
                                    <a class="btn btn-danger float-right" type="cancel" href="{{ route('fields.index') }}">
                                        <span class="text">Cancel</span>
                                    </a>
                                </div>
                            </div>
                            @method("PUT")
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


