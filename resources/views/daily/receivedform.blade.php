@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="receivedCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>แบบรับผ้าจากโรงงาน</span>
    </div>

    <hr />
    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('daily/received/add') }}" method="POST" ng-submit="submitReceivedForm()">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">วันที่รับผ้า</label>
                            <input type="text" id="received_date" name="received_date" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">บิล เล่มที่/เลขที่</label>
                            <input type="text" id="invoice" name="invoice" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">น้ำหนักผ้าสะอาด (กก.)</label>
                            <input type="text" id="total_weight" name="total_weight" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">น้ำหนักผ้าส่งซักซ้ำ (กก.) (ถ้ามี)</label>
                            <input type="text" id="repeat_weight" name="repeat_weight" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">น้ำหนักผ้าชำรุดส่งซ่อม (กก.) (ถ้ามี)</label>
                            <input type="text" id="defect_weight" name="defect_weight" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">หมายเหตุ</label>
                            <input type="text" id="remark" name="remark" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="panel-group" id="accordion">
                        
                        @foreach($drapeCates as $drapeCate)

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $drapeCate->drape_cate_id }}">
                                            {{ $drapeCate->drape_cate_name }}
                                        </a>
                                        <i class="indicator glyphicon glyphicon-chevron-down  pull-right"></i>
                                    </h4>
                                </div>
                                <div id="collapse{{ $drapeCate->drape_cate_id }}" class="panel-collapse collapse {{ (($drapeCate->drape_cate_id == '1') ? 'in' : '') }}">
                                    <div class="panel-body">
                                        <table class="table table-striped table-hover">
                                            <tr>
                                                <th style="text-align: center; width: 4%;">#</th>
                                                <th style="text-align: left;">รายการผ้า</th>
                                                <th style="text-align: center; width: 10%;">จำนวนผ้าสะอาด<br>(ชิ้น)</th>
                                                <th style="text-align: center; width: 10%;">จำนวนผ้าซักซ้ำ<br>(ชิ้น)</th>
                                                <th style="text-align: center; width: 10%;">จำนวนผ้าชำรุด<br>(ชิ้น)</th>
                                                <th style="text-align: center; width: 20%;">หมายเหตุ</th>
                                            </tr>

                                            @foreach($drapes as $drape)
                                                @if($drape->drape_cate == $drapeCate->drape_cate_id)

                                                    <tr>
                                                        <td style="text-align: center;">{{ $drape->id }}</td>
                                                        <td>{{ $drape->name }}</td>
                                                        <td style="text-align: center;">
                                                            <input  type="text" 
                                                                    id="{{ $drape->id. '_amount' }}" 
                                                                    name="{{ $drape->id. '_amount' }}" 
                                                                    class="form-control" 
                                                                    style="text-align: center;"
                                                                    ng-blur="calculateTotal()">
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <input  type="text" 
                                                                    id="{{ $drape->id. '_return' }}" 
                                                                    name="{{ $drape->id. '_return' }}" 
                                                                    class="form-control" 
                                                                    style="text-align: center;">
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <input  type="text" 
                                                                    id="{{ $drape->id. '_return' }}" 
                                                                    name="{{ $drape->id. '_return' }}" 
                                                                    class="form-control" 
                                                                    style="text-align: center;">
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <input  type="text" 
                                                                    id="{{ $drape->id. '_remark' }}" 
                                                                    name="{{ $drape->id. '_remark' }}" 
                                                                    class="form-control">
                                                        </td>
                                                    </tr>

                                                @endif
                                            @endforeach
                                        
                                        </table>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>                
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary pull-right">บันทึก</button>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="tmpTotal" name="tmpTotal" value="0">
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function($) {
        var dateNow = new Date();

        $('#received_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });

    function toggleChevron(e) {
        $(e.target)
            .prev('.panel-heading')
            .find("i.indicator")
            .toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
    }

    $('#accordion').on('hidden.bs.collapse', toggleChevron);
    $('#accordion').on('shown.bs.collapse', toggleChevron);
</script>

@endsection
