@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="sentoutCtrl">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">แก้ไขรายการส่งผ้าไปโรงงาน</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>แก้ไขรายการส่งผ้าไปโรงงาน [ ID : {{ $sentout->id }} ]</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentout/add') }}" method="POST" ng-submit="submitSentoutForm()">
                <input type="hidden" id="id" name="id" value="{{ $sentout->id }}">
                {{ csrf_field() }}                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่ส่ง</label>
                        <input type="text" id="sentout_date" name="sentout_date" value="{{ $sentout->date }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">เลขที่ใบส่งผ้า</label>
                        <input type="text" id="invoice" name="invoice" value="{{ $sentout->invoice_no }}" class="form-control">
                    </div>
                </div>
                

                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: center; width: 4%;">#</th>
                                <th style="text-align: left;">รายการผ้า</th>
                                <th style="text-align: center; width: 10%;">จำนวน นน. (กก.)</th>
                                <th style="text-align: center; width: 10%;">จำนวนชิ้น (ผืน)</th>
                                <th style="text-align: center; width: 25%;">หมายเหตุ</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($sentoutTypes as $sentoutType)                                

                                <tr>
                                    <td style="text-align: center;">
                                        {{ $sentoutType->sentout_type_id }}
                                    </td>
                                    <td>
                                        {{ $sentoutType->sentout_type_name . ' (' . $sentoutType->count_method_desc . ')' }}
                                    </td>

                                    <?php $detail = App\SentoutDailyDetail::where(['sentout_daily_id' => $sentout->id])
                                                                        ->where(['sentout_type_id' => $sentoutType->sentout_type_id])
                                                                        ->first();
                                    ?>

                                            @if($sentoutType->count_method == '1')
                                                <td style="text-align: center;">
                                                    <input  type="text" 
                                                            id="{{ $sentoutType->sentout_type_id. '_weight' }}" 
                                                            name="{{ $sentoutType->sentout_type_id. '_weight' }}"
                                                            value="{{ ($detail ) ? $detail->amount : '' }}"
                                                            class="form-control" 
                                                            style="text-align: center;"
                                                            ng-blur="calculateAllWeight()">
                                                </td>

                                                <td style="text-align: center;">&nbsp;</td>
                                            @endif

                                            @if($sentoutType->count_method == '2')
                                                <td style="text-align: center;">&nbsp;</td>
                                                <td style="text-align: center;">
                                                    <input  type="text" 
                                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}"
                                                            value="{{ ($detail ) ? $detail->amount : '' }}"
                                                            class="form-control" 
                                                            style="text-align: center;">
                                                </td>
                                            @endif
                                    
                                            @if($sentoutType->count_method == '3')
                                                <td style="text-align: center;">
                                                    <input  type="text" 
                                                            id="{{ $sentoutType->sentout_type_id. '_weight' }}" 
                                                            name="{{ $sentoutType->sentout_type_id. '_weight' }}" 
                                                            value="{{ ($detail ) ? $detail->amount : '' }}"
                                                            class="form-control" 
                                                            style="text-align: center;"
                                                            ng-blur="calculateAllWeight()">
                                                </td>
                                                <td style="text-align: center;">
                                                    <a  ng-click="popUpDetailItems()"
                                                        class="btn btn-info btn-xs">
                                                        <i class="fa fa-list" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            @endif

                                            <td style="text-align: center;">
                                                <input  type="text" 
                                                        id="{{ $sentoutType->sentout_type_id. '_remark' }}" 
                                                        name="{{ $sentoutType->sentout_type_id. '_remark' }}" 
                                                        value="{{ ($detail ) ? $detail->remark : '' }}"
                                                        class="form-control">
                                            </td>
                                </tr>
                                
                            @endforeach

                            <tr>
                                <td colspan="2" style="text-align: right;"><b>น้ำหนักรวม</b></td>
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="total" 
                                            name="total"
                                            value="{{ $sentout->total }}"
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <!-- <tr>
                                <td colspan="2" style="text-align: right;"><b>ซักซ้ำ</b></td>
                                <td style="text-align: center;">
                                    <input type="text" id="return" name="return" class="form-control" style="text-align: center;">
                                </td>
                                <td>&nbsp;</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <textarea id="remark" name="remark" rows="3" class="form-control">{{ $sentout->remark }}</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-warning pull-right">แก้ไข</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#sentout_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
