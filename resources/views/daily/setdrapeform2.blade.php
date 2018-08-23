@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="setdrapeCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปหน่วยงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/setdrape/add2') }}" method="POST" ng-submit="submitSentinForm2()">
                {{ csrf_field() }}
                <input type="hidden" id="_id" name="_id" value="{{ $setdrape->id }}"> 

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">คลัง</label>
                        <select id="_stock" name="_stock" class="form-control">
                            <option value="">-- กรุณาเลือก --</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}" <?=(($stock->id == $_stock) ? 'selected' : '')?> >
                                    {{ $stock->stock_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">วันที่จ่าย</label>
                        <input  type="text" 
                                id="sent_time" 
                                name="sent_time" 
                                class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">จำนวนผู้ป่วย</label>
                        <input  type="text" 
                                id="patient_num" 
                                name="patient_num" 
                                value="{{ $setdrape->patient_num }}" 
                                class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <input  type="text" 
                                id="remark" 
                                name="remark" 
                                value="{{ $setdrape->remark }}" 
                                class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">สต็อก</th>
                        <th style="text-align: center; width: 10%;">เบิก</th>
                        <th style="text-align: center; width: 10%;">จ่าย</th>
                        <!-- <th style="text-align: center; width: 10%;">ยอดรวม</th> -->
                        <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                    </tr>

                    @foreach($sets as $set)
                        
                        <tr>
                            <td style="text-align: center;">{{ $set->id }}</td>
                            <td>{{ $set->set_name }}</td>

                            <?php $setdrape_detail = DB::table("setdrape_daily_detail")  
                                                ->where(['setdrape_daily_id' => $setdrape->id])
                                                ->where(['set_id' => $set->id])
                                                ->first();
                            ?>

                            <td style="text-align: center;">
                                {{ ($setdrape_detail) ? $setdrape_detail->stock_amt : '' }}
                            </td>
                            <td style="text-align: center;">
                                {{ ($setdrape_detail) ? $setdrape_detail->request_amt : '' }}
                            </td>
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $set->id. '_sent' }}" 
                                        name="{{ $set->id. '_sent' }}"
                                        ng-blur="calculateTotalSent()"
                                        class="form-control" 
                                        style="text-align: center;">
                            </td>
                            <!-- <td style="text-align: center;">
                                <input  type="text" 
                                        id="@{{ data.id + '_balance' }}" 
                                        name="@{{ data.id + '_balance' }}" 
                                        class="form-control" 
                                        style="text-align: center;">
                            </td> -->
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $set->id. '_remark' }}" 
                                        name="{{ $set->id. '_remark' }}" 
                                        class="form-control">
                            </td>

                        </tr>
                            
                    @endforeach

                </table>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary pull-right">บันทึก</button>
                    </div>
                </div>

                <input type="hidden" id="total_sent" name="total_sent">

            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#sent_time').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
