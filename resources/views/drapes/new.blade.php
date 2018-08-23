@extends('layouts.main')

@section('content')
<div class="container-fluid">
    
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">@{{title}}</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>
            รายการประวัติการบำรุงรักษารถ
            {{ $vehicle[0]->cate->vehicle_cate_name }}
            {{ $vehicle[0]->type->vehicle_type_name }}
            {{ $vehicle[0]->manufacturer->manufacturer_name }}
            ทะเบียน {{ $vehicle[0]->reg_no }} {{ $vehicle[0]->changwat->short }}
        </span>
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
                        <th style="width: 8%; text-align: center;">วันที่ซ่อม</th>
                        <th style="width: 10%; text-align: center;">เลขระยะทางเมื่อเข้าซ่อม</th>
                        <th style="text-align: center;">รายละเอียด</th>                    
                        <th style="width: 8%; text-align: center;">ค่าใช้จ่าย</th>
                        <th style="width: 12%; text-align: center;">สถานที่ซ่อม</th>
                        <th style="width: 10%; text-align: center;">ผู้แจ้ง</th>
                        <th style="width: 10%; text-align: center;">หมายเหตุ</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>
                    @foreach($maintenances as $maintenance)
                    <tr>
                        <td style="text-align: center;">
                            {{ $maintenance->maintain_id }}
                        </td>        
                        <td style="text-align: center;">{{ $maintenance->maintain_date }}</td>
                        <td style="text-align: center;">{{ $maintenance->mileage }}</td>
                        <td>{{ $maintenance->maintain_topic }}</td>
                        <td style="text-align: center;">{{ $maintenance->maintain_total }}</td>
                        <td style="text-align: center;">{{ $maintenance->garage->garage_name }}</td>
                        <td style="text-align: center;">
                            {{ $maintenance->user->person_firstname }}  {{ $maintenance->user->person_lastname }}
                        </td>
                        <td>{{ $maintenance->maintain_description }}</td>
                        <td style="text-align: center;">
                            <a href="{{$maintenance->maintain_id}}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{$maintenance->maintain_id}}" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($maintenances->currentPage() !== 1)
                    <li>
                        <a href="{{ $maintenances->url($maintenances->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$maintenances->lastPage(); $i++)
                    <li class="{{ ($maintenances->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $maintenances->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($maintenances->currentPage() !== $maintenances->lastPage())
                    <li>
                        <a href="{{ $maintenances->url($maintenances->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
