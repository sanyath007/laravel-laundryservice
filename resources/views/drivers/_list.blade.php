@extends('layouts.main')

@section('content')
<div class="container-fluid">
  <!-- page title -->
  <div class="page__title">
    <span>รายการพนักงานขับรถ</span>
    <a class="btn btn-primary pull-right">
      <i class="fa fa-plus" aria-hidden="true"></i>
      New
    </a>
  </div>

  <hr />
  <!-- page title -->

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <tr>
            <th style="width: 5%; text-align: center;">#</th>
            <th style="width: 20%; text-align: center;">เลขประจำตัวประชาชน</th>
            <th>ชื่อ-สกุล</th>
            <th style="width: 20%; text-align: center;">เบอร์ติดต่อ</th>
            <th style="width: 10%; text-align: center;">Actions</th>
          </tr>
          @foreach($drivers as $driver)
          <tr>
            <td style=" text-align: center;">{{ $driver->driver_id }}</td>
            <td style=" text-align: center;">{{ $driver->person_id }}</td>
            <td>{{ $driver->description }}</td>
            <td style=" text-align: center;">{{ $driver->person->person_tel }}</td>
            <td style=" text-align: center;">
              <a href="{{$driver->driver_id}}" class="btn btn-warning">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              <a href="{{$driver->driver_id}}" class="btn btn-danger">
                <i class="fa fa-times" aria-hidden="true"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
