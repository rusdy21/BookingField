@extends('layouts.index')

@section('content')
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{route('users.update',$item->id)}}" class="user" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="namaMember">Name</label>
                                </div>
                                <div class="col-sm-7 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('name') is-invalid

                                    @enderror" id="name" name="name" value="{{ old ('name') ? old ('name') : $item->name}}">
                                    @error('name')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="nomorHandphone">Email</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="text" class="form-control @error('email') is-invalid

                                    @enderror" id="email" name="email" value="{{ old ('email') ? old ('email') : $item->email}}">
                                </div>
                                @error('email')
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
                                    <a class="btn btn-danger float-right" type="cancel" href="{{ route('users.index') }}">
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


