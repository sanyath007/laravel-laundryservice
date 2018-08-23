@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="sentinCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>ยอดส่งผ้าไปหน่วยงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/sentin/add2') }}" method="POST" ng-submit="submitSentinForm2()">
                {{ csrf_field() }}
                <input type="hidden" id="_id" name="_id" value="{{ $sentins[0]->id }}"> 

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
                                value="{{ $sentins[0]->patient_num }}" 
                                class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">หมายเหตุ</label>
                        <input  type="text" 
                                id="remark" 
                                name="remark" 
                                value="{{ $sentins[0]->remark }}" 
                                class="form-control">
                    </div>
                </div>
                
                <table class="table table-striped">
                    <tr>
                        <th style="text-align: center; width: 4%;">#</th>
                        <th style="text-align: left;">รายการผ้า</th>
                        <th style="text-align: center; width: 10%;">จำนวนเบิก</th>
                        <th style="text-align: center; width: 10%;">จำนวนส่ง</th>
                        <!-- <th style="text-align: center; width: 10%;">ยอดรวม</th> -->
                        <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                    </tr>

                    @foreach($drapes as $drape)
                        
                        <tr>
                            <td style="text-align: center;">{{ $drape->id }}</td>
                            <td>{{ $drape->name }}</td>

                            <?php $sentin = DB::table("sentin_daily_detail")  
                                                ->where(['sentin_daily_id' => $sentins[0]->id])
                                                ->where(['drape_id' => $drape->id])
                                                ->first();
                            ?>

                            <td style="text-align: center;">
                                {{ ($sentin) ? $sentin->request_amt : '' }}
                            </td>
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $drape->id. '_sent' }}" 
                                        name="{{ $drape->id. '_sent' }}"
                                        ng-blur="calculateSentTotal()"
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
                                        id="{{ $drape->id. '_remark' }}" 
                                        name="{{ $drape->id. '_remark' }}" 
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

                <input type="hidden" id="sent_total" name="sent_total">

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
