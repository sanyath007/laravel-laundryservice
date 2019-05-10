@extends('layouts.main')

@section('content')

<div class="container-fluid" ng-controller="receivedCtrl">
    <!-- page title -->
    <div class="page__title">
        <span>แบบจำหน่ายผ้า</span>
    </div>

    <hr />

    <!-- page title -->

    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('dispose/add') }}" method="POST">
                {{ csrf_field() }}
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">วันที่จำหน่ายผ้า</label>
                            <input type="text" id="dispose_date" name="dispose_date" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">                        
                        <label for="">ประเภทการจำหน่าย</label><br>
                        <input type="radio" id="dispose_type" name="dispose_type" value="1"> ชำรุด 
                        <input type="radio" id="dispose_type" name="dispose_type" value="2"> สูญหาย
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">รายการผ้า</label>
                            <select id="drape_id" name="drape_id" class="form-control">
                                <option>-- กรูณาเลือก --</option>

                                @foreach($drapes as $drape)
                                    <option value="{{ $drape->id }}">{{ $drape->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">ปีที่ซื้อผ้า (พ.ศ.)</label>
                            <input type="text" id="drape_year" name="drape_year" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">จำนวน (ชิ้น)</label>
                            <input type="text" id="amount" name="amount" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">หมายเหตุ</label>
                            <input type="text" id="remark" name="remark" class="form-control">
                        </div>
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

        $('#dispose_date').datetimepicker({
            useCurrent: true,
            format: 'YYYY-MM-DD',
            defaultDate: moment(dateNow)
        });
    });
</script>

@endsection
