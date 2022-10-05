@extends('layouts.index')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-success">Booking List</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <a href="{{route('booking.create')}}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">New Booking</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Member Name</th>
                                    <th>Field</th>
                                    <th>Date Booking</th>
                                    <th>Time Start</th>
                                    <th>Time Finish</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Member Name</th>
                                    <th>Field</th>
                                    <th>Date Booking</th>
                                    <th>Time Start</th>
                                    <th>Time Finish</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                @forelse ($items as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->nama_member}}</td>
                                    <td>{{$item->nama_field}}</td>
                                    <td>{{$item->booking_date}}</td>
                                    <td>{{$item->time_start}}</td>
                                    <td>{{$item->time_end}}</td>
                                    <td>
                                        <a href="{{route('booking.edit', $item->id_booking)}}" class="btn btn-info btn-sm">
                                            <i class="fa fa-pencil-fill">

                                            </i>
                                        </a>

                                        <form action="{{route('booking.destroy', $item->id_booking)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash">

                                                </i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7">
                                        Data Tidak Tersedia
                                    </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
