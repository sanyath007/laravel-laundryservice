@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- page title -->
    <div class="page__title">
        <span>ทะเบียนรับ-จ่ายผ้า (Stock Card)</span>
    </div>

    <hr />
    <!-- page title -->
  
    <div class="row">
        <div class="col-md-12">

            <div>
                <p><b>รายการ : </b>{{ $drape[0]->name }}</p>
                <p><b>หน่วยนับ : </b>{{ $drape[0]->unit }}</p>
            </div><br>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 4%; text-align: center;">#</th>
                        <th style="width: 15%; text-align: center;">เลขที่เบิก</th>
                        <th style="width: 15%; text-align: center;">วันที่เบิก</th>
                        <th style="width: 8%; text-align: center;">ผ้าปี</th>
                        <th style="width: 8%; text-align: center;">IN/OUT</th>
                        <th style="width: 8%; text-align: center;">จำนวน</th>
                        <th style="width: 8%; text-align: center;">คงเหลือ</th>
                        <th style="text-align: center;">หมายเหตุ</th>
                        <th style="width: 10%; text-align: center;">Actions</th>
                    </tr>

                    @foreach($stocks as $stock)

                        <tr>
                            <td style="text-align: center;">
                                {{ $stock->id }}
                            </td>
                            <td style="text-align: center;">{{ $stock->po_id }}</td>
                            <td style="text-align: center;">{{ $stock->stock_date }}</td>
                            <td style="text-align: center;">{{ $stock->drape_year }}</td>
                            <td style="text-align: center;">{{ ($stock->stock_type=='1') ? 'IN' : 'OUT' }}</td>
                            <td style="text-align: center;">{{ $stock->amount }}</td>
                            <td style="text-align: center;">{{ $stock->balance }}</td>
                            <td style="text-align: center;">{{ $stock->remark }}</td>
                            <td style="text-align: center;">
                                <a href="{{ $stock->id }}" class="btn btn-warning">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                <a href="{{ $stock->id }}" class="btn btn-danger">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach

                </table>
            </div>
            
            <ul class="pagination">
                @if($stocks->currentPage() !== 1)
                    <li>
                        <a href="{{ $stockss->url($stocks->url(1)) }}" aria-label="Previous">
                            <span aria-hidden="true">First</span>
                        </a>
                    </li>
                @endif
                
                @for($i=1; $i<=$stocks->lastPage(); $i++)
                    <li class="{{ ($stocks->currentPage() === $i) ? 'active' : '' }}">
                        <a href="{{ $stocks->url($i) }}">
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                @if($stocks->currentPage() !== $stocks->lastPage())
                    <li>
                        <a href="{{ $stocks->url($stocks->lastPage()) }}" aria-label="Previous">
                            <span aria-hidden="true">Last</span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
    </div>
</div>
@endsection
