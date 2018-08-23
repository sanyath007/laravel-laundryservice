@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="setdrapeCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดเบิกเซตผ้ารายวัน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/setdrape/add') }}" method="POST" ng-submit="submitSetdrapeForm()">
                {{ csrf_field() }}

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">คลัง</label>
                        <select id="_stock" name="_stock" class="form-control" ng-change="loadSetforWard()" ng-model="stocks">
                            <option value="">-- กรุณาเลือก --</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->stock_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่เบิก</label>
                        <input type="text" id="request_time" name="request_time" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">จำนวนผู้ป่วยประจำวัน</label>
                        <input type="text" id="patient_num" name="patient_num" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <input type="text" id="remark" name="remark" class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการเซตผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวน stock</th>
                        <th style="text-align: center; width: 10%;">จำนวนเบิก</th>
                        <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                    </tr>

                    <tr ng-repeat="(index, data) in setforward">
                        <td style="text-align: center;">@{{ data.id }}</td>
                        <td>@{{ data.set_name }}</td>
                        <td style="text-align: center;">
                            <input  type="text" 
                                    id="@{{ data.id + '_stock' }}" 
                                    name="@{{ data.id + '_stock' }}"
                                    class="form-control" 
                                    style="text-align: center;">
                        </td>
                        <td style="text-align: center;">
                            <input  type="text" 
                                    id="@{{ data.id + '_request' }}" 
                                    name="@{{ data.id + '_request' }}"
                                    ng-blur="calculateTotalRequest()"
                                    class="form-control" 
                                    style="text-align: center;">
                        </td>
                        <td style="text-align: center;">
                            <input  type="text" 
                                    id="@{{ data.id + '_remark' }}" 
                                    name="@{{ data.id + '_remark' }}" 
                                    class="form-control">
                        </td>
                    </tr>
                </table>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right">บันทึก</button>
                    </div>
                </div>
                
                <input type="hidden" id="total_request" name="total_request">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#request_time').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
