@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>รายการรถ</span>
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
                        <th style="width: 10%; text-align: center;">ประเภท</th>
                        <th style="width: 10%; text-align: center;">ชนิด</th>
                        <th style="width: 10%; text-align: center;">ยี่ห้อ</th>
                        <th>รายละเอียดรถ</th>
                        <th style="width: 10%; text-align: center;">เลขทะเบียน
                        <th style="width: 10%; text-align: center;">วันที่จดทะเบียน</th>
                        <!-- <th>ราคา</th> -->
                        <th>หมายเหตุ</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($vehicles as $vehicle)
                    <tr>
                        <td style="text-align: center;">
                            {{ $vehicle->vehicle_id }}
                        </td>
                        <td>{{ $vehicle->cate->vehicle_cate_name }}</td>
                        <td>{{ $vehicle->type->vehicle_type_name }}</td>
                        <td style="text-align: center;">
                            {{ $vehicle->manufacturer->manufacturer_name }}
                        </td>
                        <td>
                            รุ่น {{ $vehicle->model }}
                            เครื่องยนต์ {{ $vehicle->fuel->fuel_type_name }} - ซีซี
                            สี{{ $vehicle->color }} 
                            ปี {{ $vehicle->year }}               
                        </td>
                        <td style="text-align: center;">
                            {{ $vehicle->reg_no }} {{ $vehicle->changwat->short }}
                        </td>            
                        <td style="text-align: center;">{{ $vehicle->reg_date }}</td>
                        <!-- <td>{{ $vehicle->purchased_cost }}</td> -->
                        <td>{{ $vehicle->remark }}</td>
                        <td style="text-align: center;">
                            <a href="{{$vehicle->vehicle_id}}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{$vehicle->vehicle_id}}" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($vehicles->currentPage() !== 1)
                    <li>
                        <a href="{{ $vehicles->url($vehicles->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$vehicles->lastPage(); $i++)
                    <li class="{{ ($vehicles->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $vehicles->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($vehicles->currentPage() !== $vehicles->lastPage())
                    <li>
                        <a href="{{ $vehicles->url($vehicles->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
