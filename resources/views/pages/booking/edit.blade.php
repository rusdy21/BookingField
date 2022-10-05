@extends('layouts.index')

@section('content')
<div class="container-fluid">

    <div class="row mt-4">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Booking</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <form action="{{route('booking.update',$item->id_booking)}}" class="user" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="namaMember">Nama Member</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <select name="member" id="member" class="form-control">
                                        <option value="">== Select Member ==</option>
                                        @foreach ($member as $item_member)
                                            <option value="{{ $item_member->id_member}}" {{$item->id_member == $item_member->id_member ? 'selected':''}}>{{ $item_member->nama_member}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}" />
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="field">Field</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <select name="field" id="field" class="form-control">
                                        <option value="">== Select Field ==</option>
                                        @foreach ($field as $item_field)
                                            <option value="{{ $item_field->id_field}}"  {{$item->id_field == $item_field->id_field ? 'selected':''}}>{{ $item_field->nama_field}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="tanggalBooking">Tanggal Booking</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="text" class="form-control datepicker @error('BookingDate') is-invalid

                                    @enderror" id="BookingDate" name="BookingDate" value="{{$item->booking_date}}">
                                </div>
                                @error('BookingDate')
                                        <div class="text-muted">{{$message}}</div>
                                    @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="TimeStart">Time Start</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <select class="form-control" name="time_start" id="time_start">
                                        @foreach ($time_start as $item_start)
                                            <option value="{{ $item_start->slot}}" {{$item->time_start == $item_start->slot ? 'selected':''}}>{{ $item_start->slot}}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2 mb-3 mb-sm-0 col-form-label">
                                    <label for="timeFinish">Time Finish</label>
                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <select class="form-control" name="time_finish" id="time_finish">
                                        @foreach ($time_finish as $item_finish)
                                            <option value="{{ $item_finish->slot}}" {{$item->time_end == $item_finish->slot ? 'selected':''}}>{{ $item_finish->slot}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0 col-form-label">

                                </div>
                                <div class="col-sm-3 mb-3 mb-sm-0">
                                    <button class="btn btn-info ml-5" type="submit">
                                        <span class="text">Simpan</span>
                                    </button>
                                    <a class="btn btn-danger float-right" type="cancel" href="{{ route('booking.index') }}">
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

@section('new_script')
<script>

/*.....Date-Start Change....*/
$(document).ready(function () {
  $('#BookingDate').on('change', function () {
      var BookingDate = this.value;
      var Field = $("#field").val();

      $("#time_start").html('');
      $("#time_finish").html('');
      $.ajax({
          url: "{{route('booking.timestart')}}",
          type: "POST",
          data: {
              BookingDate: BookingDate,
              Field : Field,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (result) {
              $('#time_start').html('<option value="">-- Start Time --</option>');
              $.each(result.time_start, function (key, value) {
                  $("#time_start").append('<option value="' + value.slot + '">' + value.slot + '</option>');
              });
              $('#time_finish').html('<option value="">-- Finish Time --</option>');
          }
      });
  })});


/*......Time-Start Change.....*/
$(document).ready(function () {
  $('#time_start').on('change', function () {
      var time_start = this.value;
      var Field = $("#field").val();
      var BookingDate = $("#BookingDate").val();
      $("#time_finish").html('');
      $.ajax({
          url: "{{route('booking.timefinish')}}",
          type: "POST",
          data: {
              BookingDate: BookingDate,
              Field : Field,
              time_start : time_start,
              _token: '{{csrf_token()}}'
          },
          dataType: 'json',
          success: function (result) {
              $('#time_finish').html('<option value="">-- Finish Time --</option>');
              $.each(result.time_finish, function (key, value) {
                  $("#time_finish").append('<option value="' + value.slot + '">' + value.slot + '</option>');
              });
          }
      });
  })});

</script>
@endsection

