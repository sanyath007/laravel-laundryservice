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
                    @foreach($brings as $bring)
                    <tr>
                        <td style="text-align: center;">
                            {{ $bring->id }}
                        </td>
                        <td>{{ $bring->cate->bring_cate_name }}</td>
                        <td>{{ $bring->type->bring_type_name }}</td>
                        <td style="text-align: center;">
                            {{ $bring->manufacturer->manufacturer_name }}
                        </td>
                        <td>
                            รุ่น {{ $bring->model }}
                            เครื่องยนต์ {{ $bring->fuel->fuel_type_name }} - ซีซี
                            สี{{ $bring->color }} 
                            ปี {{ $bring->year }}               
                        </td>
                        <td style="text-align: center;">
                            {{ $bring->reg_no }} {{ $bring->changwat->short }}
                        </td>            
                        <td style="text-align: center;">{{ $bring->reg_date }}</td>
                        <!-- <td>{{ $bring->purchased_cost }}</td> -->
                        <td>{{ $bring->remark }}</td>
                        <td style="text-align: center;">
                            <a href="{{$bring->bring_id}}" class="btn btn-warning">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{$bring->bring_id}}" class="btn btn-danger">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            
            <ul class="pagination">
                @if($brings->currentPage() !== 1)
                    <li>
                        <a href="{{ $brings->url($brings->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$brings->lastPage(); $i++)
                    <li class="{{ ($brings->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $brings->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($brings->currentPage() !== $brings->lastPage())
                    <li>
                        <a href="{{ $brings->url($brings->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
