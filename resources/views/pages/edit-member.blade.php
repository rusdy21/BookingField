@extends('layouts.index')

@section('content')
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Member</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{route('member.update',$item->id_member)}}" class="user" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="namaMember">Member Name</label>
                                </div>
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <input type="hidden" name="idMember" id="idMember">
                                    <input type="text" class="form-control @error('namaMember') is-invalid

                                    @enderror" id="namaMember" name="namaMember" value="{{ old ('namaMember') ? old ('namaMember') : $item->nama_member}}">
                                    @error('namaMember')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="nomorHandphone">Nomor Handphone</label>
                                </div>
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('nomorHandphone') is-invalid

                                    @enderror" id="nomorHandphone" name="nomorHandphone" value="{{ old ('hp_member') ? old ('hp_member') : $item->hp_member}}">
                                </div>
                                @error('nomorHandphone')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="alamatMember">Alamat</label>
                                </div>
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <textarea class="ckeditor form-control @error('alamatMember') is-invalid

                                    @enderror" id="alamatMember" name="alamatMember">{{ old ('alamat_member') ? old ('alamat_member') : $item->alamat_member}}</textarea>
                                </div>
                                @error('alamatMember')
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
                                    <a class="btn btn-danger float-right" type="cancel" href="{{ route('member.index') }}">
                                        <span class="text">Cancel</span>
                                    </a>
                                </div>
                            </div>@method('PUT')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


