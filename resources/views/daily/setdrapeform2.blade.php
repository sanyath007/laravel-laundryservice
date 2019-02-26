@extends('layouts.main')

@section('content')
<div class="container-fluid" ng-controller="setdrapeCtrl">

    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/daily/setdrape/list') }}">เบิก-จ่ายเซตผ้า OR</a></li>
        <li class="breadcrumb-item active">เบิกเซตผ้า</li>
    </ol>

    <!-- page title -->
    <div class="page__title">
        <span>เบิกเซตผ้า</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/setdrape/dispense'.$isnew) }}" method="POST" ng-submit="submitSentinForm2()">
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
                                value="{{ $setdrape->date }}"
                                class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">รอบที่จ่าย</label>
                        <input  type="number" 
                                id="times" 
                                name="times"
                                value="1" 
                                value="{{ $setdrape->remark }}" 
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
                        <th style="text-align: center; width: 8%;">สต็อก</th>
                        <th style="text-align: center; width: 8%;">ใช้ไป</th>
                        <th style="text-align: center; width: 8%;">สติ๊เกอร์</th>
                        <th style="text-align: center; width: 8%;">จ่าย1<br>(10.00น.)</th>

                        @if($isnew != 1)
                            <th style="text-align: center; width: 8%;">จ่าย2<br>(15.00น.)</th>
                            <th style="text-align: center; width: 8%;">จ่าย3<br>(19.00น.)</th>
                        @endif

                        <!-- <th style="text-align: center; width: 8%;">จ่ายรวม</th> -->
                        <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                    </tr>

                    <?php $isComplete = 0; ?>
                    @foreach($sets as $set)
                        
                        <?php $setdrape_detail = DB::table("setdrape_daily_detail")  
                                                ->where(['setdrape_daily_id' => $setdrape->id])
                                                ->where(['set_id' => $set->id])
                                                ->first();
                        ?>

                        <tr>
                            <td style="text-align: center;">{{ $set->id }}</td>
                            <td>{{ $set->set_name }}</td>
                            <td style="text-align: center;">
                                {{ ($setdrape_detail) ? $setdrape_detail->stock_amt : '' }}
                            </td>
                            <td style="text-align: center;">
                                {{ ($setdrape_detail) ? $setdrape_detail->request_amt : '' }}
                            </td>
                            <td style="text-align: center;">
                                @if($setdrape_detail && is_null($setdrape_detail->sentout_amt))   
                                    <input  type="text" 
                                            id="{{ $set->id. '_sentout' }}" 
                                            name="{{ $set->id. '_sentout' }}" 
                                            class="form-control" 
                                            style="text-align: center;">
                                @else
                                    {{ ($setdrape_detail) ? $setdrape_detail->sentout_amt : '' }}
                                @endif
                            </td>
                            <td style="text-align: center;">
                                @if($setdrape_detail && is_null($setdrape_detail->sentin1_amt))                                    
                                    <input  type="text" 
                                            id="{{ $set->id. '_sentin1' }}" 
                                            name="{{ $set->id. '_sentin1' }}"
                                            ng-blur="calculateTotalSent()"
                                            class="form-control" 
                                            style="text-align: center;">
                                @else
                                    {{ ($setdrape_detail) ? $setdrape_detail->sentin1_amt : '' }}
                                @endif
                            </td>

                            @if($isnew != 1)

                                <td style="text-align: center;">
                                    @if($setdrape_detail && is_null($setdrape_detail->sentin2_amt))
                                        <input  type="text" 
                                                id="{{ $set->id. '_sentin2' }}" 
                                                name="{{ $set->id. '_sentin2' }}"
                                                ng-blur="calculateTotalSent()"
                                                class="form-control" 
                                                style="text-align: center;">
                                    @else
                                        {{ ($setdrape_detail) ? $setdrape_detail->sentin2_amt : '' }}
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    @if($setdrape_detail && is_null($setdrape_detail->sentin3_amt))
                                        <input  type="text" 
                                                id="{{ $set->id. '_sentin3' }}" 
                                                name="{{ $set->id. '_sentin3' }}"
                                                ng-blur="calculateTotalSent()"
                                                class="form-control" 
                                                style="text-align: center;">
                                    @else
                                        {{ ($setdrape_detail) ? $setdrape_detail->sentin3_amt : '' }}
                                        <?php $isComplete = 1; ?>
                                    @endif
                                </td>

                            @endif

                            <!-- <td style="text-align: center;">
                                @if($setdrape_detail)
                                    <?php $sentin_all = (int)$setdrape_detail->sentin1_amt + (int)$setdrape_detail->sentin2_amt + (int)$setdrape_detail->sentin3_amt; ?>
                                    <input  type="text" 
                                            id="{{ $set->id. '_sentin' }}" 
                                            name="{{ $set->id. '_sentin' }}"
                                            value="{{ $sentin_all }}" 
                                            readonly="readonly"
                                            class="form-control" 
                                            style="text-align: center;">
                                @endif
                            </td>        -->
                            <td style="text-align: center;">
                                <input  type="text" 
                                        id="{{ $set->id. '_remark' }}" 
                                        name="{{ $set->id. '_remark' }}" 
                                        class="form-control">
                            </td>
                        </tr>
                            
                    @endforeach

                </table>

                @if($isComplete != 1)
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary pull-right">บันทึก</button>
                        </div>
                    </div>
                @endif

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
