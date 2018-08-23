@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="sentoutCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>แบบส่งผ้าไปโรงงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentout/add') }}" method="POST" ng-submit="submitSentoutForm()">
                {{ csrf_field() }}                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่ส่ง</label>
                        <input type="text" id="sentout_date" name="sentout_date" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">เลขที่ใบส่งผ้า</label>
                        <input type="text" id="invoice" name="invoice" class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวน นน. (กก.)</th>
                        <th style="text-align: center; width: 10%;">จำนวนชิ้น (ผืน)</th>
                        <th style="text-align: center; width: 25%;">หมายเหตุ</th>
                    </tr>

                    @foreach($sentoutTypes as $sentoutType)

                        <tr>
                            <td style="text-align: center;">
                                {{ $sentoutType->sentout_type_id }}
                            </td>
                            <td>
                                {{ $sentoutType->sentout_type_name . ' (' . $sentoutType->count_method_desc . ')' }}
                            </td>
                            
                            @if($sentoutType->count_method == '1')
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
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
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                            @endif
                            
                            @if($sentoutType->count_method == '3')
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                                <td style="text-align: center;">
                                    <input  type="text" 
                                            id="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            name="{{ $sentoutType->sentout_type_id. '_amount' }}" 
                                            class="form-control" 
                                            style="text-align: center;">
                                </td>
                            @endif
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $sentoutType->sentout_type_id. '_remark' }}" 
                                        name="{{ $sentoutType->sentout_type_id. '_remark' }}" 
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
                                    class="form-control" 
                                    style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <!-- <tr>
                        <td colspan="2" style="text-align: right;"><b>ซักซ้ำ</b></td>
                        <td style="text-align: center;">
                            <input type="text" id="return" name="return" class="form-control" style="text-align: center;">
                        </td>
                        <td>&nbsp;</td>
                    </tr> -->

                </table>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right">บันทึก</button>
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
